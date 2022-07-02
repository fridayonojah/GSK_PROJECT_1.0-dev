/**
 * All the files that are in this folder are project specific meaning they do a particular activity in this application
 * both the main file and the page feature files
 */

(function (params) {
    
    const btns_open_model = document.querySelectorAll('.view-file');
    const btn_close_model = document.getElementById('btn_close_modal');
    const elem_model_container = document.getElementById('app_modal_container');
    const img_modal_img = document.getElementById('modal-image');
    const elem_gray_container = document.querySelector('.hash-container.image-modal');
    const btn_download_img_modal = document.getElementById('btn_download_img_modal');

    const club_img_host = 'https://club.nnl.com.ng/';
    
    const close_image_modal = () => {
        elem_model_container.classList.remove("show-modal");
        img_modal_img.setAttribute('src', ``);
        elem_gray_container.toggleAttribute('hidden');
        img_modal_img.toggleAttribute("hidden");
    }
    
    btns_open_model.forEach(btn => {
        btn.addEventListener('click', e => {
            const target_element = e.target;
            const img_src = target_element.getAttribute('data-view-file');
            elem_model_container.classList.add("show-modal");
            console.log(`Image value: ${img_src}`);
            testImage(`${club_img_host}static/uploads/${img_src}`);
            btn_download_img_modal.href = `${club_img_host}static/uploads/${img_src}`;
            btn_download_img_modal.download = `${img_src}`;
        });
    });
    
    btn_close_model.addEventListener('click', close_image_modal);
    
    img_modal_img.addEventListener('load', () => {
        elem_gray_container.toggleAttribute('hidden');
        img_modal_img.toggleAttribute("hidden");
     })
     
    img_modal_img.addEventListener('error', event => {
        console.log('How far there is an error ', event);
    })
    
    img_modal_img.addEventListener('success', () => {
        console.log('It loaded successfully');  
    })

    // function exports
    
    
    function testImage(URL) {
        var tester=new Image();
        tester.onload= () => {
            imageFound(URL);   
        }
        tester.onerror=imageNotFound;
        tester.src=URL;
    }
    
    function imageFound(img_url) {
        img_modal_img.setAttribute('src', img_url);
    }
    
    function imageNotFound() {
        alert('That image was not found.');
    }
    

})();

