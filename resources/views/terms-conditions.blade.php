@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)
 
@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/privacy-policy.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h1 class="title">Terms and Conditions</h1>
        <br>

        <div class="content">
            <h5 class="privacy1">Introduction</h5>
            <p>Welcome to <a href="#">www.dropshippingscout.com</a>. These terms and conditions outline the rules and regulations for using Dropshippingscout.com Website, located at <a href="#">www.dropshippingscout.com</a>.
            </p>
            <p>By accessing this website, we assume you fully accept these terms and conditions. Only continue to use <a href="#">www.dropshippingscout.com</a> if you agree to all of the terms and conditions stated on this page.</p>
            <h5>Intellectual Property Rights</h5> 
            <p>Other than the content you own, which you may have opted to include on this Website, under these Terms, <a href="#">www.dropshippingscout.com</a> and its licensors own all rights to the intellectual property and material contained in this Website, and all such rights are reserved. You are granted a limited license only, subject to the restrictions provided in these terms, for viewing the material on this Website.</p>
            <h5>Restrictions</h5> 
            <p>You are expressly restricted from all of the following:</p>
            <ul>
             <li>Publishing any Website material in any media;</li>
             <li>Selling, sublicensing, and otherwise commercialising any Website material;</li>  
             <li>Publicly performing and showing any Website material;</li>
             <li>Using this Website in any way that is, or maybe, damaging to this Website;</li>  
             <li>Using this Website in any way that impacts user access to this Website;</li>
             <li>Using this Website contrary to applicable laws and regulations or in a way that causes, or may cause, harm to the Website or any person or business entity;</li>  
             <li>Engaging in any data mining, data harvesting, data extracting, or any other similar activity about this Website or while using this Website;</li>
             <li>Using this Website to engage in any advertising or marketing(Certain areas of this Website are restricted from your access, and <a href="#">www.dropshippingscout.com</a> may further limit you from accessing any areas of this Website at any time, at your sole and absolute discretion. Any user ID and password you may have for this Website are confidential, and you must maintain confidentiality.</li>    
            </ul> 
            <h5>Your Content</h5>
            <p>In these Website Standard Terms and Conditions, "Your Content" shall mean any audio, video, text, images, or other material you display. Concerning Your Content, by displaying it, you grant <a href="#">www.dropshippingscout.com</a> a non-exclusive, worldwide, irrevocable, royalty-free, sublicensable license to use, reproduce, adapt, publish, translate, and distribute it in any media.</p>
            <p>Your Content must be your own and not infringe on any third party’s rights. <a href="#">www.dropshippingscout.com</a> reserves the right to remove any of your content from this Website at any time and for any reason without notice.</p>
            <h5>No warranties</h5>
            <p>This Website is provided "as is," with all faults, and <a href="#">www.dropshippingscout.com</a> makes no express or implied representations or warranties of any kind related to this Website or the materials contained on this Website. Additionally, nothing on this Website shall be construed as providing consultation or advice to you.</p>
            <h5>Limitation of liability</h5>
            <p>In no event shall <a href="#">www.dropshippingscout.com</a>, nor any of its officers, directors, and employees, be liable to you for anything arising out of or in any way connected with your use of this Website, whether such liability is under contract, tort or otherwise. <a href="#">www.dropshippingscout.com</a>, including its officers, directors, and employees, shall not be liable for any indirect, consequential, or special liability arising out of or in any way related to your use of this Website.</p>
            <h5>Indemnification</h5>
            <p>You, at this moment, indemnify to the fullest extent <a href="#">www.dropshippingscout.com</a> from and against any liabilities, costs, demands, causes of action, damages, and expenses arising in any way related to your breach of any of the provisions of these Terms.</p>
            <h5>Severability</h5>
            <p>If any provision of these Terms is found to be unenforceable or invalid under any applicable law, such unenforceability or invalidity shall not render these Terms unenforceable or invalid as a whole, and such provisions shall be deleted without affecting the remaining provisions herein.</p>
            <h5>Variation of Terms</h5>
            <p><a href="#">www.dropshippingscout.com</a> is permitted to revise these Terms at any time as it sees fit, and by using this Website, you are expected to review such Terms regularly to ensure you understand all terms and conditions governing the use of this Website</p>
            <h5>Assignment</h5>
            <p><a href="#">www.dropshippingscout.com</a> can assign, transfer, and subcontract its rights and obligations under these Terms without any notification or consent required. However, you shall not be permitted to assign, transfer, or subcontract any of your rights and obligations under these Terms.</p>
            <h5> Entire Agreement</h5>
            <p>These Terms, including any legal notices and disclaimers on this Website, constitute the entire agreement between <a href="#">www.dropshippingscout.com</a> and you about your use of this Website and supersede all prior agreements and understandings concerning the same.</p>
            <h5>Governing Law & Jurisdiction</h5>
            <p>These Terms will be governed by and construed by the laws of the State of [Your State], and you submit to the non-exclusive jurisdiction of the state and federal courts located in [Your State] to resolve any disputes.</p>
        </div>
    </div>

                  
</div>
@endsection