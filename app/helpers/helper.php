<?php 

class Helper {
   

   public function upLoadFile($path, $file){
        $img = $request->file('file');
        $img_name = time().'.'.$img->getClientOriginalExtension();
        $img->move('uploads/images', $img_name);
        return \Redirect::back();
        
    }
}