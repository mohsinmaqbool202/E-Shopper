<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\CmsPage;
use App\Category;
use App\Banner;

class CmsController extends Controller
{
    public function addCmsPage(Request $request)
    {
    	if($request->isMethod('post')){
    		$data = $request->all();
    		if(empty($data['status'])){
    			$data['status'] = 0;
    		}
    		else{
    			$data['status'] = 1;
    		}
    		CmsPage::create($data);
    		return redirect('/admin/view-cms-pages')->with('flash_message_success', 'Page has been added.');
    	}

    	//get request
    	return view('admin.pages.add_cms_page');
    }

    public function viewCmsPages()
    {
    	$cmsPages = CmsPage::all();
    	return view('admin.pages.view_cms_pages', compact('cmsPages'));
    }

    public function editCmsPage(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            if(empty($data['status'])){
                $data['status'] = 0;
            }
            else{
                $data['status'] = 1;
            }

            $page = CmsPage::find($id);
            $page->under = $data['under'];
            $page->title = $data['title'];
            $page->url =   $data['url'];
            $page->description  = $data['description'];
            $page->status   = $data['status'];
            $page->save();

            return redirect('/admin/view-cms-pages')->with('flash_message_success', 'Page has been updated.');
        }

    	//for get request
        $page = CmsPage::find($id);
        return view('admin.pages.edit_cms_page', compact('page'));
    }

    public function deleteCmsPages($id)
    {
    	$page = CmsPage::find($id);
    	$page->delete();

    	return redirect()->back()->with('flash_message_success', 'Page has been deleted.');
    }

    public function cmsPage($url)
    {
        $cmsPage = CmsPage::where('url', $url)->first();

        //Get CAtegoried and sun-categories
        $categories = Category::with('categories')->where('parent_id', 0)->get();

        //get all banners
        $banners  = Banner::where('status', 1)->get();
        return view('pages.cms_page', compact('cmsPage', 'categories', 'banners'));
    }

    public static function fetchPages()
    {
        $servicePages   = CmsPage::where(['under'=> 'Service','status'=>1])->get();
        $quickShopPages = CmsPage::where(['under'=> 'Quick Shop','status'=>1])->get();
        $policyPages   = CmsPage::where(['under'=> 'Policies','status'=>1])->get();
        $aboutPages   = CmsPage::where(['under'=> 'About Shopper','status'=>1])->get();

        $data['servicePages']   = $servicePages;
        $data['quickShopPages'] = $quickShopPages;
        $data['policyPages']    = $policyPages;
        $data['aboutPages']     = $aboutPages;
        return $data;
    }

    public function contact(Request $request)
    {
      if($request->isMethod('post'))
      {
        $data = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        //send contact email
        $email = "mohsinmaqbool451@gmail.com";
        $messageData = [
          'name'   => $data['name'],
          'email'   => $data['email'],
          'subject'   => $data['subject'],
          'comment'   => $data['message']
        ];
        Mail::send('emails.enquiry', $messageData, function($message)use($email){
          $message->to($email)->subject('Enquiry from E-Shop Website');
        });

        return redirect()->back()->with('flash_message_success', 'Thanks for your enquiry. We will get back to you soon.');
      }

      //Get CAtegoried and sun-categories
      $categories = Category::with('categories')->where('parent_id', 0)->get();
      //get all banners
      $banners  = Banner::where('status', 1)->get();
      return view('pages.contact', compact('categories', 'banners'));
    }
}
