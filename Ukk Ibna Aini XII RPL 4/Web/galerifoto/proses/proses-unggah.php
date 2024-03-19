<?php
session_start();
include 'koneksi.php';
if (isset($_POST['submit'])) {

                                $fotoid         = $_POST['fotoid'];
                                $judulfoto      = $_POST['judulfoto'];
                                $deskripsifoto  = $_POST['deskripsifoto'];
                                $tanggalunggah  = date('Y-m-d');
                                $albumid        = $_POST['albumid'];
                                $userid         = $_POST['userid'];


                                $filename = $_FILES['lokasifile']['name'];
                                $tmp_name = $_FILES['lokasifile']['tmp_name'];

                                $type1 = explode('.', $filename);
                                $type2 = $type1[1];

                                $newname = 'foto' . time() . '.' . $type2;

                                // menampung data format yang diizinkan
                                $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                                // validasi format file
                                if (!in_array($type2, $tipe_diizinkan)) {
                                    // jika format file tidak ada di dalam tipe diizinkan
                                    echo '<script>alert("Format file tidak diizinkan")</script>';
                                } else {
                                    // proses upload file sekaligus insert ke database
                                    move_uploaded_file($tmp_name, '../foto/' . $newname);


                                    // Mendapatkan nilai tertinggi dari fotoid
                                    $result = mysqli_query($conn, "SELECT MAX(fotoid) as max_fotoid FROM foto");
                                    $row = mysqli_fetch_assoc($result);
                                    $next_fotoid = $row['max_fotoid'] + 1;

                                    // Menggunakan $next_fotoid dalam query INSERT
                                    $insert = mysqli_query($conn, "INSERT INTO foto (fotoid, judulfoto, deskripsifoto, tanggalunggah, albumid, userid, lokasifile) VALUES (
                                '" . $next_fotoid . "',
                                '" . $judulfoto . "',
                                '" . $deskripsifoto . "',
                                '" . $tanggalunggah . "',
                                '" . $albumid . "',
                                '" . $userid . "',
                                '" . $newname . "'
                            )");


                                    if ($insert) {
                                        echo '<script>alert("Simpan data berhasil")</script>';
                                        echo '<script>window.location="../foto.php"</script>';
                                    } else {
                                        echo 'Gagal' . mysqli_error($conn);
                                    }
                                }
                            }
                            ?>