<?php
namespace App\Helpers;
use App\Models\Faq;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Image;
use DB;

class Helper
{

    public function __construct()
    {

    }

    // $model: Model 
    public static function countTopFlag($model){
        return $model::select('*')->where('top_flag', 1)->count();
    }

    public static function getLastItemInArray($array)
    {
        if(is_object($array))
        {
            $array = $array->toArray();
        }

        if(count($array) > 0)
        {
            return $array[count($array) - 1];
        }
        return $array;
    }

    public static function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public static function getUserName($firstName, $lastName)
    {
        return $firstName . ' ' . $lastName;
    }


     /**
     * Calc return nextPage & preveous page in pagination
     *
     * @param  NUMBER  $currentPage
     * @param  NUMBER  $lastPage
     * @return array
     */
    public static function calcPagination($currentPage, $lastPage)
    {
        $nextPageCustom = $currentPage + 1;
        $prevPageCustom = $currentPage - 1;
        return compact('nextPageCustom', 'prevPageCustom');
    }

     /**
     * Save file and return file path.
     *
     * @param  STRING  $directory
     * @param  FILE  $file
     * @param  STRING|NULL  $filePath
     * @param  STRING|NULL  $fileName
     * @param  ARRAY|NULL  $resizeInfo
     * @return String --- file path
     */
    public static function uploadFile($directory, $file, $filePath = null, $fileName = null, array $resizeInfo = null)
    {
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $fileName . "." . $extension;

        if(!empty($filePath))
        {
            $checkExist = Storage::disk('public')->exists(str_replace("storage/", "", $filePath));
            if($checkExist)
            Storage::disk('public')->delete(str_replace("storage/", "", $filePath));
        }

        if($fileName)
        {
            if($resizeInfo)
            {
                $photo = Helper::resizeImage($file, $resizeInfo["width"], $resizeInfo["height"], $extension);
                $save  = Storage::disk('public')->put($directory . "/" . $fileNameToStore, $photo->__toString());
                if($save) {
                    return ltrim($directory . "/" . $fileNameToStore, "/");
                }

            }
            return Storage::disk('public')->putFileAs($directory, $file, $fileNameToStore);
        }else{

            $fileNameToStore = Str::random(30) .'.'.$extension;
            if($resizeInfo)
            {

                $photo = Helper::resizeImage($file, $resizeInfo["width"], $resizeInfo["height"], $extension);
                $save =  Storage::disk('public')->put($directory . "/" . $fileNameToStore, $photo->__toString());
                if($save) {
                    return ltrim($directory . "/" . $fileNameToStore, "/");
                }
            }

            return Storage::disk('public')->putFileAs($directory, $file, $fileNameToStore);
        }
    }
    public static function resizeImage($image, $width, $height, $extension)
    {
        return Image::make($image)->resize($width, $height)->encode($extension);
    }


     /**
     * Save file and return file path.
     *
     * @param  STRING  $imagePath
     * @return String
     */
    public static function getDirectoryFile($imagePath)
    {
        if(Str::contains($imagePath, "storage"))
        {
            $imagePath = str_replace("storage/", "", $imagePath);
        }
        return dirname($imagePath);
    }

}
