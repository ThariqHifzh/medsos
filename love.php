<!-- Tombol untuk men-trigger fungsi toggleLike -->
<a class="btn" onclick="toggleLike(this, <?php echo $rowPosting['id']; ?>)">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="white" stroke="gray"
        stroke-width="1">
        <path
            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
    </svg>
</a>

<!-- Hidden input untuk menyimpan user ID -->
<input type="hidden" id="user_id_like" value="<?php echo $userId; ?>">

<script>
function toggleLike(element, statusId) {
    // Ubah warna ikon love
    const svg = element.querySelector('svg');
    const currentFill = svg.getAttribute('fill');
    svg.setAttribute('fill', currentFill === 'white' ? 'red' : 'white');

    // Ambil user ID dari input tersembunyi
    const userId = document.getElementById('user_id_like').value;

    // Kirim data statusId dan userId ke server menggunakan fetch
    fetch("like_status.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `status_id=${statusId}&user_id=${userId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "liked") {
                console.log("Status liked");
            } else if (data.status === "unliked") {
                console.log("Status unliked");
            }
        })
        .catch(error => console.error("Error:", error));
}
</script>