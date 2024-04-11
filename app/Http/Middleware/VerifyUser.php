<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;

class VerifyUser
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization'); // Check for common header name
        
        if (!$token) {
            return response()->json(['error' => 'Token missing'], 401); // Early termination
        }

        // Extract user ID from token logic here (replace with your token format logic)
        $userId = substr($token, 0, 36);

        $user=  User::where('uniqueId', $userId)->first();
        $userId = $user->id;

        $request->merge(['userId' => $userId]);

        return $next($request);
    }
}
