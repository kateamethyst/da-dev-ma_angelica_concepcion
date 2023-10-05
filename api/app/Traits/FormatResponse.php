<?php

namespace App\Traits;

trait FormatResponse
{

    /**
     * Returns error response
     *
     * @param Illuminate\Validation\Validator $validator
     * @param string $error_code
     * @param array $data
     * @param int $status
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function errorResponse(
        $validator,
        $error_code = null,
        $data = [],
        $status = 400
    ) {

        return response()->json(
            $this->formatErrorResponse($validator, $error_code, $data),
            $status
        );
    }

    /**
     * Formats success response of a resource
     * Use this if the response data is a resource like paginated data.
     * Only mimics the formatSuccessResponse()
     *
     * @param $resource
     * @param $appends
     * @param $message
     * @return array
     */
    public function successResourceResponse(
        $resource,
        $message = null,
        $appends = []
    ) {
        $additional = [
            'success' => true,
            'error_code' => null,
            'message' => $message,
        ];

        if ($appends) {
            $additional = array_merge($additional, $appends);
        }

        $response = [
            ...$resource->response()->getData(true),
            ...$additional
        ];

        return response()->json(
            $response,
            200
        );
    }
}
