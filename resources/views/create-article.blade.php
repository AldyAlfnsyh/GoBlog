

<x-layout>
    <x-slot:title>{{$title}}</x-slot>
    <x-slot:header_title>{{$header_title}}</x-slot>
    
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <h2 class="mb-4 text-xl font-bold text-gray-900 ">Add a new article</h2>
          
          <form action="/create-article/{{ $post['slug'] ?? '' }}" method="POST" enctype="multipart/form-data">

            @csrf
            <input type="hidden" name='id' value="{{$post['id'] ?? ''}}"/>

            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Title</label>
                <input type="text" name="name" id="name" value="{{$post['title']  ?? ''}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     :ring-primary-500 :border-primary-500" placeholder="Type your Title Article" required="">
                
              </div>

              <div>
                  <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                  <input type="text" name="category" value="{{$post->category['name']  ?? ''}}" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5     :ring-primary-500 :border-primary-500" placeholder="input category">
              </div> 

              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Upload image</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 " id="file_input" type="file" 
                value="{{$post['image']  ?? ''}}"
                name="image"
                >
              </div> 


              <div class="sm:col-span-2 mb-6">
                         
                <label for="body" class="block mb-2 text-sm font-medium text-gray-900 ">Body</label>

                <input id="x" type="hidden" name="body" value="{{ $post['body'] ?? '' }}">
                <trix-editor input="x"></trix-editor>

                
              </div>

              <div class='sm:col-span-2 mt-4'>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 :ring-primary-900 hover:bg-primary-800">
                  Add article
                </button>
              </div>

            </div>
          </form>
        </div>
    <script>
document.addEventListener("trix-attachment-add", function(event) {
    const attachment = event.attachment;

    if (attachment.file) {
        uploadFile(attachment);
    }
});

function uploadFile(attachment) {
    const formData = new FormData();
    formData.append("file", attachment.file);

    fetch("/upload", {
        method: "POST",
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    }).then(res => res.json())
      .then(data => {
          attachment.setAttributes({
              url: data.url,
              href: data.url
          });
      });
}


    </script>
    
    
  </x-layout>
  
    
