<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * TAVARDT Elite Security Headers Middleware
 * 
 * Instructions: 
 * 1. Place this file in app/Http/Middleware/
 * 2. Register it in your app/Http/Kernel.php within the $middleware array
 *    so it runs on every HTTP request.
 */
class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request and inject B2B-grade security headers.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Ensure response is capable of receiving headers
        if (method_exists($response, 'header')) {

            // 1. Defend against Clickjacking (prevents iframe embedding)
            $response->header('X-Frame-Options', 'SAMEORIGIN');

            // 2. Prevent MIME type sniffing
            $response->header('X-Content-Type-Options', 'nosniff');

            // 3. Enable Browser XSS Protection
            $response->header('X-XSS-Protection', '1; mode=block');

            // 4. Referrer Policy (Protects data leakage in URLs)
            $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');

            // 5. HTTP Strict Transport Security (HSTS)
            // Forces browsers to ONLY use HTTPS for the next year (Crucial for SaaS)
            $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

            // 6. Basic Content Security Policy (CSP)
            // Prevents loading scripts from unauthorized domains.
            // Note: Adjust the CSP directives to match your external CDNs (like Google Fonts).
            $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:;");
            
            // Remove Laravel/PHP identification headers
            if (function_exists('header_remove')) {
                header_remove('X-Powered-By');
                header_remove('Server');
            }
        }

        return $response;
    }
}
