<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = getenv('JWT_SECRET');
        $header = $request->getHeaderLine('Authorization');

        if(empty($header)){
            return Services::response()
                ->setJSON(['status' => 'error', 'message' => 'Token jwt tidak ditemukan di header'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        $token = explode(' ', $header)[1] ?? null;

        if(!$token){
            return Services::response()
                ->setJSON(['status' => 'error', 'message' => 'Format token salah'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        try{
            $decode = JWT::decode($token, new Key($key, 'HS256'));
            $request->user_id = $decode->data->id;

        } catch (\Throwable $e) {
            return Services::response()
                ->setJSON(['status' => 'error', 'message' => 'Token jwt tidak valid atau kadaluarsa'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
