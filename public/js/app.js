const dragArea= document.querySelector('.drag-area');
const dragText = document.querySelector('.header');

let input = document.querySelector('#inputimg');

let file;

//saat browse file
input.addEventListener('change', function(){
        file = this.files[0];
        dragArea.classList.add('active');
        console.log(file);
        displayfile();
});

// //saat file didalam drag area
// dragArea.addEventListener('dragover', (event) => {
//     event.preventDefault();
//     dragText.textContent = 'Release to Upload';
//     dragArea.classList.add('active');
//     // console.log('file ada didalam drag area');
// });

// // saat file meninggalkan drag area
// dragArea.addEventListener('dragleave', () => {
// dragText.textContent = 'Drag & Drop';
//     // console.log('file ada diluar drag area'); 
// });

// //saat file di drop di drag area
// dragArea.addEventListener('drop', (event) => {
//     event.preventDefault();

//     file = event.dataTransfer.files[0];
//     // console.log(file);
//     displayfile();
// });

function displayfile(){
    let fileType = file.type;
    // console.log(fileType);

    let validExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

    if(validExtensions.includes(fileType)){
        let fileReader = new FileReader();
        fileReader.onload = () => {
            let fileURL = fileReader.result;
            // console.log(fileURL);
            let imgtag = `<img src="${fileURL}" alt="">`;
            dragArea.innerHTML = imgtag;
        };  
        fileReader.readAsDataURL(file);
    } else{
        alert('Harap Upload File Berupa Gambar');
        dragArea.classList.remove('active');
        input.value = "";
    }
    // console.log('file didrop di drag area');
};



