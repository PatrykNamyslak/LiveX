<?php
namespace LiveX\Support\Http;

use Probe\Support\Arr;
use Probe\Support\Enums\HttpErrorResponseCode;
use Probe\Support\Enums\HttpMethod;
use Probe\Support\JSON;
use Probe\Support\JSONResponse;
use Probe\Support\Traits\Stringable;
use ReflectionClass;


class Request{
    use Stringable;

    public function __toString(): string{
        return JSON::encode(new ReflectionClass($this)->getAttributes());
    }

    /**
     * Get all of the incoming JSON data: 
     * @return array
     */
    public static function incomingData(): array{
        return JSON::decode(file_get_contents("php://input"));
    }

    /**
     * @param string $method The HTTP method used for the request. `GET`,`POST`,`PATCH`,`DELETE`,`PUT`
     * @param JSON $componentSnapshot The snapshot that was rendered on the frontend.
     * @param JSON $hashedComponentSnapshot The hashed snapshot of the currently rendered component, this is stored in a unique element in the DOM that holds this value. Used to prevent any changes from the frontend leaking into the backend
     * @param string $action The name of the method that will be called on the component.
     */
    protected function __construct(protected HttpMethod $method, protected JSON $componentSnapshot, protected JSON $hashedComponentSnapshot, protected string $action){}

    public static function capture(): self|JSONResponse{
        $method = HttpMethod::tryFrom($_SERVER['REQUEST_METHOD']);
        $incomingData = self::incomingData();
        if (!$incomingData){
            return new JSONResponse(responseCode: HttpErrorResponseCode::BAD_REQUEST,message: "Payload cannot be empty.",);
        }
        $requiredData = [
            "snapshot",
            "hashed_snapshot",
            "action",
        ];
        $missing = [];
        foreach($requiredData as $requiredKey){
            if (!isset($incomingData[$requiredKey])){
                $missing[] = $requiredKey;
            }
        }
        if (Arr::count($missing) > 0){
            return new JSONResponse(
                responseCode: HttpErrorResponseCode::BAD_REQUEST, 
                message: "Looks like you are missing required parameters", 
                body: ["request_method" => $method, "missing_parameters" => $missing]
            );
        }
        $componentSnapshot = JSON::fromJSON(json: $_POST["snapshot"]) ?? null;
        $hashedComponentSnapshot = JSON::fromJSON(json: $_POST["hashed_snapshot"]) ?? null;
        $action = $_POST["action"];
        return new self(method: $method, componentSnapshot: $componentSnapshot, hashedComponentSnapshot: $hashedComponentSnapshot, action: $action);
    }
}