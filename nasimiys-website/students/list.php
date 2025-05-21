<?php
require_once '../inc/auth.php';
require_once '../inc/db.php';

if (!isLoggedIn()) {
    header('Location: ../index.php');
    exit;
}

include '../inc/header.php';
?>

<h2>Talabalar ro'yxati</h2>

<input type="text" id="search" class="form-control mb-3" placeholder="Qidiruv...">

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ism</th>
            <th>Familiya</th>
            <th>Guruh</th>
            <th>Web Dasturlash</th>
            <th>Kompyuter Tarmoqlari</th>
            <th>Ehtimollar va Statistika</th>
            <th>Masofaviy Ta'lim</th>
            <th>Suniy Intellekt</th>
            <?php if (isAdmin()): ?>
            <th>Amallar</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody id="studentTableBody"></tbody>
</table>

<?php if (isAdmin()): ?>
<a href="add.php" class="btn btn-success">Yangi talaba qo'shish</a>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const isAdmin = <?= isAdmin() ? 'true' : 'false' ?>;

function loadStudents(query='') {
    $.ajax({
        url: 'search.php',
        type: 'GET',
        data: {q: query},
        dataType: 'json',
        success: function(data) {
            console.log(data); // Javobni konsolga chiqarish, tekshirish uchun

            let rows = '';
            data.forEach(function(student) {
                rows += `<tr>
                    <td>${student.id}</td>
                    <td>${student.ism}</td>
                    <td>${student.familiya}</td>
                    <td>${student.guruh}</td>
                    <td>${student.web_dasturlash ?? ''}</td>
                    <td>${student.kompyuter_tarmoqlari ?? ''}</td>
                    <td>${student.ehtimollar_statistika ?? ''}</td>
                    <td>${student.masofaviy_talim ?? ''}</td>
                    <td>${student.suniy_intellekt ?? ''}</td>`;

                if (isAdmin) {
                    rows += `<td>
                        <a href="edit.php?id=${student.id}" class="btn btn-primary btn-sm me-1">Tahrirlash</a>
                        <a href="delete.php?id=${student.id}" onclick="return confirm('Rostdan o‘chirmoqchimisiz?')" class="btn btn-danger btn-sm">O‘chirish</a>
                    </td>`;
                }

                rows += `</tr>`;
            });

            $('#studentTableBody').html(rows);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
            $('#studentTableBody').html('<tr><td colspan="10">Xatolik yuz berdi</td></tr>');
        }
    });
}

$(document).ready(function() {
    loadStudents();

    $('#search').on('input', function() {
        loadStudents($(this).val());
    });
});
</script>

<?php include '../inc/footer.php'; ?>
