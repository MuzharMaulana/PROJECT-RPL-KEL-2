<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CatatanKu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f1f1f1; /* Latar belakang yang lembut */
            font-family: Arial, sans-serif; /* Font yang bersih dan modern */
        }
        .note-container, .folder-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Lebar maksimum untuk kontainer */
            margin: auto; /* Pusatkan kontainer */
        }
        h2 {
            color: #007bff; /* Warna judul yang menarik */
            text-align: center; /* Pusatkan judul */
            margin-bottom: 20px;
        }
        textarea {
            resize: none; /* Mencegah perubahan ukuran textarea */
            border: 1px solid #ccc; /* Batas warna netral */
            border-radius: 5px; /* Sudut membulat */
        }
        button {
            width: 100%; /* Tombol penuh lebar */
            border-radius: 5px; /* Sudut membulat */
        }
        .note {
            margin: 10px 0;
            padding: 15px;
            background-color: #e7f3fe; /* Warna latar belakang catatan */
            border-left: 6px solid #2196F3; /* Garis sisi biru */
            border-radius: 5px; /* Sudut membulat */
            position: relative; /* Untuk mengatur posisi tombol hapus */
        }
        .note:hover {
            background-color: #d1e7ff; /* Efek hover pada catatan */
            transition: background-color 0.3s; /* Transisi halus */
        }
        .delete-btn {
            position: absolute; /* Posisi absolut untuk tombol hapus */
            top: 10px; /* Jarak dari atas catatan */
            right: 10px; /* Jarak dari kanan catatan */
            background-color: transparent; /* Latar belakang transparan */
            border: none; /* Tanpa batas */
            color: #ff4d4d; /* Warna merah untuk tombol hapus */
            cursor: pointer; /* Kursor pointer saat hover */
        }
        #savedNotes {
            max-height: 300px; /* Batas tinggi untuk daftar catatan */
            overflow-y: auto; /* Mengizinkan scroll jika melebihi batas */
            margin-top: 15px; /* Jarak atas dari judul */
        }
        .folder {
            background-color: #d4edda; /* Warna latar belakang folder */
            border-left: 6px solid #28a745; /* Garis sisi hijau */
            padding: 10px;
            margin: 15px 0;
            border-radius: 5px;
            cursor: pointer; /* Kursor pointer saat hover */
        }
        .folder-title {
            font-weight: bold; /* Judul folder tebal */
        }
        .folder-notes {
            margin-top: 10px; /* Jarak dari nama folder */
            display: none; 
        }
    </style>
</head>
<body>

    <div class="note-container">
        <a href="index.php"> <h2>CatatanKu</h2> </a>
        <input id="folderInput" class="form-control" type="text" placeholder="Nama Folder" />
        <textarea id="noteInput" class="form-control mt-3" rows="5" placeholder="Tulis catatan di sini..."></textarea>
        <button id="saveButton" class="btn btn-primary mt-3">Simpan Catatan</button>
        <h4 class="mt-4">Catatan Tersimpan:</h4>
        <div id="savedNotes"></div>
    </div>

    <div class="folder-container mt-5">
        <h4>Folder Tersimpan:</h4>
        <div id="folderList"></div>
    </div>

    <script>
        const saveButton = document.getElementById('saveButton');
        const noteInput = document.getElementById('noteInput');
        const folderInput = document.getElementById('folderInput');
        const savedNotes = document.getElementById('savedNotes');
        const folderList = document.getElementById('folderList');

        // Menyimpan catatan dan folder
        saveButton.addEventListener('click', () => {
            const note = noteInput.value.trim(); // Menghapus spasi sebelum dan sesudah
            const folder = folderInput.value.trim(); // Menghapus spasi folder
            if (note) {
                const folderName = folder || 'Tanpa Folder'; // Menampilkan nama folder
                
                // Membuat elemen baru untuk catatan
                const noteElement = document.createElement('div');
                noteElement.className = 'note';
                noteElement.innerHTML = `${note} <button class="delete-btn">Hapus</button>`;
                
                // Menambahkan catatan yang disimpan ke dalam folder
                addNoteToFolder(folderName, noteElement);

                // Mengosongkan area input setelah menyimpan
                noteInput.value = ''; 
                folderInput.value = ''; // Mengosongkan input folder
            } else {
                alert('Tolong masukkan catatan sebelum menyimpan.');
            }
        });

        // Fungsi untuk menambahkan catatan ke folder
        function addNoteToFolder(folderName, noteElement) {
            // Mengecek apakah folder sudah ada
            const existingFolder = Array.from(folderList.children).find(folder => 
                folder.dataset.name === folderName
            );

            if (!existingFolder) {
                // Membuat elemen folder baru
                const folderElement = document.createElement('div');
                folderElement.className = 'folder';
                folderElement.dataset.name = folderName;
                folderElement.innerHTML = `<span class="folder-title">${folderName}</span>`;
                const folderNotes = document.createElement('div');
                folderNotes.className = 'folder-notes'; // Div untuk catatan dalam folder
                folderNotes.appendChild(noteElement); // Menambahkan catatan ke dalam folder
                folderElement.appendChild(folderNotes);
                folderList.appendChild(folderElement);

                // Menambahkan event listener untuk menampilkan/hide catatan dalam folder
                folderElement.addEventListener('click', () => {
                    const notes = folderElement.querySelector('.folder-notes');
                    notes.style.display = notes.style.display === 'block' ? 'none' : 'block'; // Toggle visibility
                });
            } else {
                // Menambahkan catatan ke folder yang sudah ada
                const folderNotes = existingFolder.querySelector('.folder-notes');
                folderNotes.appendChild(noteElement); // Menambahkan catatan ke dalam folder
            }

            // Menambahkan event listener untuk tombol hapus pada catatan
            noteElement.querySelector('.delete-btn').addEventListener('click', () => {
                noteElement.remove(); // Menghapus catatan dari folder
                updateFolderCount(folderName); // Memperbarui jumlah catatan di folder
            });

            // Memperbarui jumlah catatan di folder
            updateFolderCount(folderName);
        }

        // Fungsi untuk memperbarui jumlah catatan di folder
        function updateFolderCount(folderName) {
            const folder = Array.from(folderList.children).find(folder => 
                folder.dataset.name === folderName
            );

            if (folder) {
                const noteCount = folder.querySelectorAll('.folder-notes .note').length; // Menghitung jumlah catatan
                const folderTitle = folder.querySelector('.folder-title');
                folderTitle.textContent = `${folderName} (${noteCount})`; // Memperbarui teks judul folder dengan jumlah catatan
            }
        }
    </script>

</body>
</html>