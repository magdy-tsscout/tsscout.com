<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminUploadHandlerController extends Controller
{
    function handleUpload(Request $request)
    {
        // 1. التحقق من أن الملف صورة فعلاً وبحجم محدد
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // الحد الأقصى 2 ميجابايت
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // تحقق إضافي للتأكد من أن الملف لم يتم التلاعب به (Mime Type Check)
            if (!$file->isValid()) {
                return response()->json(['error' => 'File is not valid'], 400);
            }

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // تخزين الملف
            $file->move(public_path('uploads'), $fileName);

            return response()->json([
                'location' => asset('uploads/' . $fileName)
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }


    # ##########################################################
    public function getUploadedImages()
    {
        $directory = public_path('uploads');
        // جلب جميع ملفات الصور من المجلد
        $files = array_diff(scandir($directory), array('.', '..'));

        $images = [];
        foreach ($files as $file) {
            $images[] = [
                'title' => $file,
                'value' => asset('uploads/' . $file)
            ];
        }

        return response()->json($images);
    }
}
