<?php

namespace App\Http\Responses;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;

class ApiResponder implements ResponsesInterface
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the status code according to a passed int
     *
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Respond with a validation error.
     *
     * @param $errors
     *
     * @return mixed
     */
    public function respondWithValidationError($errors)
    {
        return $this->setStatusCode(422)->respondWithError($errors);
    }

    /**
     * Respond with a not found error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * Respond with an internal error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Server Error!')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * Respond with an authorization error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondAuthorizationError($message = 'You don\'t have the rights to access this resource.')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * Respond with an authentication error.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondAuthenticationError($message = 'Forbidden!')
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * Respond with generic error.
     *
     * @param $message
     *
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond(['message' => $message]);
    }

    /**
     * Respond with data.
     *
     * @param $data
     *
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        $data['status_code'] = $this->getStatusCode();
        return Response::json($data, $this->getStatusCode(), $headers);
    }
}
