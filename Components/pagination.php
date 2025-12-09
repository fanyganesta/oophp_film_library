<?php if($jumlahHalaman > 1) : ?>
    <?php if($halamanAktif > 1) : ?>
        <a href="?halaman=<?= $halamanAktif - 1?>">&laquo;</a>
    <?php endif ?>
    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $halamanAktif) : ?>
            <p class="inline-bold"><?= $i ?></p>
        <?php else : ?>
            <a href="?halaman=<?= $i ?><?php if(isset($_GET['cari'])){echo "&cari=".$_GET['cari'];}?>"><?= $i ?></a>
        <?php endif ?>
    <?php endfor ?>
    <?php if($halamanAktif < $jumlahHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
    <?php endif ?>
<?php endif ?>