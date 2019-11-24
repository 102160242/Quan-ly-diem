<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('success', function ($data, $messages = [], $status = 200) {
            if(!is_array($messages)) $messages = [$messages];
            if($data instanceof JsonResource)
            {
                $data->additional(['success' => true, 'messages' => $messages]);
                return $data->response()
                            ->setStatusCode($status);
            }
            else
            {
                return Response::json([
                  'data' => $data,
                  'success'  => true,
                  'messages' => $messages,
                ], $status);
            }

        });
        Response::macro('error', function ($messages = [], $status = 400) {
            if(!is_array($messages)) $messages = [$messages];
            return Response::json([
              'success'  => false,
              'messages' => $messages,
            ], $status);
        });
    }
}
?>
