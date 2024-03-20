import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// document.addEventListener('DOMContentLoaded', function() {
//     const deleteButton = document.querySelectorAll('#btnDeleteButton');
//     deleteButton.forEach(button => {
//         button.addEventListener('click', function(event) {
            
//             const confirmation = confirm('本当に削除しますか？');
//             if(!confirmation) {
//                 event.preventDefault();
//             }
//         });
//     })
// });

// function previewImage(event) {
//     var reader = new FileReader();
//     reader.onload = function(){
//         var output = document.getElementById('imagePreview');
//         output.src = reader.result;
//     }
//     reader.readAsDataURL(event.target.files[0]);
// };
