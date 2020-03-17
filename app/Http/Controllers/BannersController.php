<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Image;
use App\Banner;

class BannersController extends Controller
{
    public function addBanner(Request $request)
    {
    	if($request->isMethod('post'))
    	{

    		$banner = new Banner;
    		$banner->title = $request->title;
    		$banner->link = $request->link;
    		
            if($request["status"] == ''){
                $banner->status = 0;
            }
            else{
                $banner->status = 1;
            }
            //Storing Banner Image
    		if($request->hasFile('image'))
    		{
    			$image_temp = Input::file('image');
    			if($image_temp->isValid())
    			{
    				$extension = $image_temp->getClientOriginalExtension();
    				$filename = rand(111,99999). '.'. $extension;
    				$banner_path = 'images/frontend_images/banners/'.$filename;

    				//Resize Image
    				Image::make($image_temp)->resize(1140,340)->save($banner_path);
     				$banner->image = $filename;
    			}
    		}
    		$banner->save();
    		return redirect('/admin/view-banners')->with('flash_message_success', 'Banner Added Successfully');
    	}

    	//for get request
    	return view('admin.banners.add_banner');
    }

    public function viewBanners()
    {
        $banners = Banner::all();
        return view('admin.banners.view_banners', compact('banners'));
    }

    public function editBanner(Request $request, $id)
    {
        //for post request
         if($request->isMethod('post'))
        {
            $data = $request->all();
            //Storing Product Image
            if($request->hasFile('image'))
            {
                $image_temp = Input::file('image');
                if($image_temp->isValid())
                {
                    $extension = $image_temp->getClientOriginalExtension();
                    $filename = rand(111,99999). '.'. $extension;

                    $banner_path = 'images/frontend_images/banners/'.$filename;

                    //Resize Image
                    Image::make($image_temp)->resize(1200,1200)->save($banner_path);
                }
            }else{
                $filename = $request->current_image;
            }

            if($request["status"] == ''){
                $status = 0;
            }
            else{
                $status = 1;
            }

            Banner::where('id', $id)->update(['title'=> $data['title'],'link'=> $data['link'],'image'=> $filename, 'status'=> $status]);
           return redirect('/admin/view-banners')->with('flash_message_success', 'Banner Updated Successfully.');
        }

        //for ger request
        $banner = Banner::where('id', $id)->first();
        return view('admin.banners.edit_banner', compact('banner'));
    }

    public function deleteBanner($id)
    {
        //Delete Product image from folders
         $bannerImage = Banner::where('id', $id)->first();
        //product images path
        $banner_path = 'images/frontend_images/banners/';

        //Delete images from folder
        if(file_exists($banner_path.$bannerImage->image)){
            unlink($banner_path.$bannerImage->image);
          }

         //Delete img from products table 
        Banner::where('id', $id)->delete();
        return back()->with('flash_message_success', 'Banner has been deleted.');
    }
}
