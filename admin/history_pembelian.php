<?php
include '../koneksi.php';

$sql = "SELECT * FROM transactions ORDER BY id ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/admin logo.png">
    <title>History Pembelian - InCinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <link href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.dataTables.min.css" rel="stylesheet">
    <style>
        .dataTables_paginate {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .dataTables_paginate ul {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 8px;
        }

        .dataTables_paginate .paginate_button {
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: white;
            color: #333;
            cursor: pointer;
            transition: background 0.2s;
        }

        .dataTables_paginate .paginate_button:hover {
            background: #007bff;
            color: white;
        }

        .dataTables_paginate .paginate_button.current {
            background: #007bff;
            color: white;
            font-weight: bold;
        }

        .dataTables_paginate .paginate_button.disabled {
            background: #e0e0e0;
            color: #999;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white p-6 h-screen fixed left-0 top-0 flex-shrink-0 overflow-y-auto">
            <h1 class="text-2xl font-bold mb-6">Admin InCinema</h1>
            <nav>
                <ul>
                    <li class="mb-4 border-b border-gray-400 pb-2">
                        <a href="dashboard.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-home mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="akun_admin.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-user mr-2"></i> Akun Admin
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="akun_mall.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-store mr-2"></i> Akun Mall
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="jadwal_film.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i> Jadwal Film
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="data_film.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-film mr-2"></i> Data Film
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="history_pembelian.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-history mr-2"></i> History Pembelian
                        </a>
                    </li>
                    <li class="mb-4 mt-6 border-t border-gray-400 pt-2">
                        <a href="index.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="ml-64 p-6 w-full overflow-auto">
            <h2 class="mb-4 text-black text-2xl font-semibold">History Pembelian</h2>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <div class="overflow-x-auto">
                    <table id="filmTable" class="min-w-full border border-gray-300">
                        <thead>
                            <tr class="bg-blue-900 text-white">
                                <th class="px-4 py-3 border">No</th>
                                <th class="px-4 py-3 border">ID Transaksi</th>
                                <th class="px-4 py-3 border">Email</th>
                                <th class="px-4 py-3 border">Nama Film</th>
                                <th class="px-4 py-3 border">Nomor Kursi</th>
                                <th class="px-4 py-3 border">Tanggal Pembayaran</th>
                                <th class="px-4 py-3 border">Jenis Pembayaran</th>
                                <th class="px-4 py-3 border">Harga</th>
                                <th class="px-4 py-3 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class='hover:bg-gray-100 text-center'>
                                <td class='px-4 py-2 border'>{$no}</td>
                                <td class='px-4 py-2 border'>{$row['order_id']}</td>
                                <td class='px-4 py-2 border'>{$row['username']}</td>
                                <td class='px-4 py-2 border'>{$row['nama_film']}</td>
                                <td class='px-4 py-2 border'>{$row['seat_number']}</td>
                                <td class='px-4 py-2 border'>{$row['transaction_time']}</td>
                                <td class='px-4 py-2 border'>{$row['payment_type']}</td>
                                <td class='px-4 py-2 border'>Rp.{$row['amount']}</td>
                                <td class='px-4 py-2 border'>";

                                    // Status dengan warna berbeda
                                    if ($row['status'] == 'settlement') {
                                        echo "<span class='bg-green-500 text-white px-3 py-1 rounded-lg'>Selesai</span>";
                                    } elseif ($row['status'] == 'pending') {
                                        echo "<span class='bg-yellow-500 text-white px-3 py-1 rounded-lg'>Menunggu</span>";
                                    } else {
                                        echo "<span class='bg-red-500 text-white px-3 py-1 rounded-lg'>{$row['status']}</span>";
                                    }

                                    echo "</td></tr>";
                                    $no++;
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center py-4 text-gray-500'>Tidak ada data</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
    <!--modal buat edit akun mall-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#filmTable').DataTable({
                dom: '<"d-flex justify-content-between align-items-center mb-3"<"col-md-6"l><"col-md-6 text-end d-flex gap-2"B>>rtip',
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-primary btn-sm',
                        text: '<i class="fas fa-copy"></i> Copy'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-success btn-sm',
                        text: '<i class="fas fa-file-excel"></i> Excel'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-warning btn-sm',
                        text: '<i class="fas fa-file-csv"></i> CSV'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger btn-sm',
                        text: '<i class="fas fa-file-pdf"></i> PDF'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info btn-sm',
                        text: '<i class="fas fa-print"></i> Print'
                    }
                ]
            });
        });
    </script>

</body>

</html>