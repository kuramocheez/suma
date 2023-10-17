<!-- Teruskan Surat Modal -->
<div class="modal fade" data-bs-backdrop="static" id="teruskanSurat">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Teruskan Surat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST">
                    <?php
                    if ($getBidang['bidang'] == "Utama") {
                    ?>
                        <div class="form-group">
                            <label for="check" class="form-label">Pilih Penerima</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check" name="penerima[]" value="Kepala Bagian Pemerintahan">
                                <label class="form-check-label">Kepala Bagian Pemerintahan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check" name="penerima[]" value="Kepala Bagian Otonomi Daerah">
                                <label class="form-check-label">Kepala Bagian Otonomi Daerah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check" name="penerima[]" value="Kepala Bagian Kerja Sama">
                                <label class="form-check-label">Kepala Bagian Kerja Sama</label>
                            </div>
                        </div>
                    <?php
                    } elseif ($getBidang['level'] == "Kepala Bagian") {
                    ?>
                        <div class="form-group">
                            <label for="check" class="form-label">Pilih Penerima</label>
                            <?php
                            $sub = mysqli_query($conn, "SELECT jabatan FROM user JOIN jabatan ON user.id_jabatan = jabatan.id WHERE level = 'Kepala Sub Bagian' AND bidang = '$bidang'");
                            while ($getSub = mysqli_fetch_array($sub)) {
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check" name="penerima[]" value="<?= $getSub['jabatan'] ?>">
                                    <label class="form-check-label"><?= $getSub['jabatan'] ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        <?php
                    } elseif ($getBidang['level'] == "Kepala Sub Bagian") {
                        ?>
                            <div class="form-group">
                                <label for="check" class="form-label">Pilih Penerima</label>
                                <?php
                                $user = mysqli_query($conn, "SELECT fullname FROM user JOIN jabatan ON user.id_jabatan = jabatan.id WHERE level = 'Staff' AND turunan = '$jabatan'");
                                while ($getUser = mysqli_fetch_array($user)) {
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check" name="penerima[]" value="<?= $getUser['fullname'] ?>">
                                        <label class="form-check-label"><?= $getUser['fullname'] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            <?php
                        }
                            ?>
                            <div class="form-floating mt-2">
                                <textarea name="keterangan" class="form-control" cols="30" rows="10" placeholder="Keterangan"></textarea>
                                <label for="keterangan" class="form-label">Keterangan Surat</label>
                            </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button class="btn btn-outline-primary" name="kirim">Kirim</button>
                </form>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>