<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Oauth2;

class GoogleCalendarController extends Controller
{
    private function getGoogleClient()
{
    $client = new Google_Client();
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
    $client->addScope([
        Google_Service_Calendar::CALENDAR,
        Google_Service_Oauth2::USERINFO_EMAIL,
    ]);
    $client->setAccessType('offline');
    $client->setPrompt('consent');
    $client->setIncludeGrantedScopes(true);

    if (Auth::check() && Auth::user()->token) {
        $token = json_decode(Auth::user()->token, true);
        $refreshToken = Auth::user()->refresh_token;

        // Configura el token actual
        $client->setAccessToken($token);

        // Si el token ha expirado, intenta refrescarlo
        if ($client->isAccessTokenExpired()) {
            if ($refreshToken) {
                try {
                    $newToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);

                    if (isset($newToken['access_token'])) {
                        // Si no se recibe un nuevo refresh token, preserva el existente
                        if (!isset($newToken['refresh_token'])) {
                            $newToken['refresh_token'] = $refreshToken;
                        }

                        // Actualiza los tokens del usuario
                        Auth::user()->update([
                            'token' => json_encode($newToken),
                            'refresh_token' => $newToken['refresh_token']
                        ]);

                        $client->setAccessToken($newToken);
                    }
                } catch (\Exception $e) {
                    // Si hay un error, elimina los tokens para forzar una reconexión
                    Auth::user()->update([
                        'token' => null,
                        'refresh_token' => null,
                        'google_id' => null,
                    ]);
                    return null;
                }
            }
        }
    }

    return $client;
}


    public function redirectToGoogle()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión antes de conectar con Google.');
        }

        $client = $this->getGoogleClient();
        return redirect()->to($client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión antes de conectar con Google.');
        }
    
        try {
            $client = $this->getGoogleClient();
            
            // Verifica que se haya recibido el código de autorización
            if (!$request->has('code')) {
                return redirect()->route('appointments.create')
                    ->withErrors(['error' => 'No se recibió el código de autorización de Google.']);
            }
    
            // Obtiene el token de acceso usando el código de autorización
            $token = $client->fetchAccessTokenWithAuthCode($request->input('code'));
    
            // Verifica que se haya recibido un token válido
            if (!isset($token['access_token'])) {
                return redirect()->route('appointments.create')
                    ->withErrors(['error' => 'Error al obtener el token de acceso.']);
            }
    
            // Establece el token de acceso
            $client->setAccessToken($token);
    
            // Obtiene la información del usuario de Google
            $oauth = new Google_Service_Oauth2($client);
            $googleUser = $oauth->userinfo->get();
    
            // Actualiza la información del usuario autenticado
            $user = Auth::user();
            $user->google_id = $googleUser->id;
            $user->token = json_encode($token);
    
            // Guarda el refresh token si está presente
            if (isset($token['refresh_token'])) {
                $user->refresh_token = $token['refresh_token'];
            }
    
            $user->save();
    
            return redirect()->route('appointments.create')
                ->with('success', 'Cuenta de Google conectada correctamente.');
                
        } catch (\Exception $e) {
            return redirect()->route('appointments.create')
                ->withErrors(['error' => 'Error al conectar con Google: ' . $e->getMessage()]);
        }
    }
    

    public function createEvent(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión antes de crear un evento.');
        }

        $client = $this->getGoogleClient();

        if (!$client || !$client->getAccessToken()) {
            return redirect()->route('calendar.login')
                ->with('error', 'Necesitas conectar tu cuenta de Google Calendar primero.');
        }

        try {
            $service = new Google_Service_Calendar($client);

            $event = new Google_Service_Calendar_Event([
                'summary' => $request->input('title'),
                'description' => $request->input('description'),
                'start' => [
                    'dateTime' => $request->input('start_time'),
                    'timeZone' => 'Europe/Madrid',
                ],
                'end' => [
                    'dateTime' => $request->input('end_time'),
                    'timeZone' => 'Europe/Madrid',
                ],
            ]);

            $calendarId = 'primary';
            $service->events->insert($calendarId, $event);

            return redirect()->route('appointments.create')
                ->with('success', 'Cita añadida a Google Calendar correctamente.');

        } catch (\Exception $e) {
            return redirect()->route('appointments.create')
                ->withErrors(['error' => 'Error al crear el evento en Google Calendar: ' . $e->getMessage()]);
        }
    }
}
