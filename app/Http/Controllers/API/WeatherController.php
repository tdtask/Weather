<?php

namespace App\Http\Controllers\API;
use App\File\FileFactory;
use App\File\Models\Weather;
use App\Weather\Handlers\WeatherRequest;
use App\Weather\WeatherFacade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;

class WeatherController extends Controller
{
    /**
     * @api {post} /api/weather/export_file
     * @apiName export_file
     * @apiGroup Weather
     * @apiPermission 
     * @apiDescription Выгрузить файл с погодой за сегодня
     *
     * @apiParam {string} [file_type] Тип выгружаемого файла. Возможные значение json,xml. Обязательный.
     *
     * @apiSuccess (0) {Integer} file Путь куда сохранился файл.
     * @apiSuccess (-1) {Integer} status Тип файла не найден.
     * @apiSuccess (-2) {Integer} status Ошибка при получении данных погоды.
     * @apiSuccess (-3) {Integer} status ОШибка при сохранении файла на диск.
     */
    public function exportFile(Request $request)
    {
        $file_type = (string)$request->post('file_type');
        switch ($file_type){
            case FileFactory::TYPE_JSON:
                $file = FileFactory::getJsonFile();
                break;
            case FileFactory::TYPE_XML:
                $file = FileFactory::getXmlFile();
                break;
            default:
                return response()->json(['code' => -1, 'error' => 'Wrong type']);
        }
        $weather = new WeatherFacade($file, new WeatherRequest());
        $weather_data = $weather->getData();
        if(isset($weather_data['error'])){
            return response()->json(['code' => -2, 'error' => $weather_data['error']]);
        }
        $weather_model = new Weather($weather_data);
        $response = $weather->saveDataToFile($weather_model);
        if(isset($response['error'])) {
            return response()->json(['code' => -3, 'error' => $response['error']]);
        }
        $full_path = Storage::disk('local')->path($response['file_name']);
        return response()->json(['code' => 0, 'file' => $full_path]);
    }
}