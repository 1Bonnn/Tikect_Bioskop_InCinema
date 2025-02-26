<!DOCTYPE html>

<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Input Film</title>
    </head>
    <body>

    <h1>Input Data Film</h1>
    <script>
        const selectedGenres = new Set();

        function addGenre() {
            const genreSelect = document.getElementById('genreSelect');
            const selectedValue = genreSelect.value;

            if (selectedValue && !selectedGenres.has(selectedValue)) {
                selectedGenres.add(selectedValue);

                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-item-center';
                listItem.textContent = selectedValue;

                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn btn-sm btn-danger';
                removeBtn.onclick = () => {
                    selectedGenres.delete(selectedValue);
                    listItem.remove();
                    updateHiddenInput();
                };

                listItem.appendChild(removeBtn);
                document.getElementById('selectedGenres').appendChild(listItem);

                updateHiddenInput();
            }

            genreSelect.value = '';
        }

        function updateHiddenInput() {
            document.getElementById('genreInput').value = Array.from(selectedGenres).join(',');
        }
    </script>

<form action="proses_input.php" method="POST" enctype="multipart/form-data">
    
<div>
        <label for="poster">Upload Poster</label>
        <input type="file" id="poster" name="poster" accept="image/*" required>
    </div>
    
    <div>
        <label for="nama_film">Nama Film</label>
        <input type="text" id="nama_film" name="nama_film" required>
    </div>
    
    <div>
        <label for="genre">Genre</label>
        <select id="genreSelect">
            <option value="" disabled selected>Pilih Genre</option>
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
            <option value="Animation">Animation</option>
            <option value="Biography">Biography</option>
            <option value="Comedy">Comedy</option>
            <option value="Crime">Crime</option>
            <option value="Disaster">Disaster</option>
            <option value="Documentary">Documentary</option>
            <option value="Drama">Drama</option>
            <option value="Epic">Epic</option>
            <option value="Erotic">Erotic</option>
            <option value="Experimental">Experimental</option>
            <option value="Family">Family</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Film-Noir">Film-Noir</option>
            <option value="History">History</option>
            <option value="Horror">Horror</option>
            <option value="Martial Arts">Martial Arts</option>
            <option value="Music">Music</option>
            <option value="Musical">Musical</option>
            <option value="Mystery">Mystery</option>
            <option value="Political">Political</option>
            <option value="Psychological">Psychological</option>
            <option value="Romance">Romance</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Sport">Sport</option>
            <option value="Superhero">Superhero</option>
            <option value="Survival">Survival/option>
            <option value="Thriller">Thriller</option>
            <option value="War">War</option>
            <option value="Western">Western</option>
    </select>
        <button type="button" onclick="addGenre()">Tambah Button</button>
    </div>

    <ul id="selectedGenres" class="mt-3 list-group d-flex flex-wrap" style="max-height: 200px; overflow-y: auto;"></ul>
    <input type="hidden" id="genreInput" name="genre">

    <div>
        <label for="banner">Upload Banner</label>
        <input type="file" id="banner" name="banner" accept="image/*" required>
    </div>
    
    <div>
        <label for="menit">Total Menit</label>
        <input type="text" id="menit" name="menit" required>
    </div>

    <div>
    <label for="usia">Usia</label>
    <select id="usia"name="usia" required>
        <option value="" disabled selected>Pilih Usia</option>
        <option value="13">13</option>
        <option value="17">17</option>
        <option value="SU">SU</option>
    </select>
</div>

<div>
    <label for="trailer">Upload Trailer</label>
    <input type="file" id="trailer" name="trailer" accept="video/*">
</div>

<div>
    <label for="judul">Deskripsi</label>
    <input type="text" id="judul" name="judul" required>
</div>

<div>
    <label for="dimensi">Berapa Dimensi</label>
    <select id="dimensi" name="dimensi" required>
        <option value="" disabled selected>Pilih Dimensi</option>
        <option value="2D">2D</option>
        <option value="3D">3D</option>
    </select>
</div>

<div>
    <label for="producer">Producer</label>
    <input type="text" id="producer" name="producer" required>
</div>

<div>
    <label for="director">Director</label>
    <input type="text" id="director" name="director" required>
</div>

<div>
    <label for="writer">Writer</label>
    <input type="text" id="writer" name="writer" required>
</div>

<div>
    <label for="cast">Cast</label>
    <input type="text" id="cast" name="cast" required>
</div>

<div>
    <label for="distributor">Distributor</label>
    <input type="text" id="distributor" name="distributor" required>
</div>

<div>
    <label for="harga">Harga Per Tiket</label>
    <input type="number" id="harga" name="harga" required>
</div>

<button type="submit">Simpan</button>
</form>
    </body>
</html>