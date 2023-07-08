<div class="table-responsive">
    <table id="tb-ortu" class="table table-bordered table-hover">
        <thead class="bg-secondary">
            <tr>
                <th style="width: 8%;">#</th>
                <th>Nama</th>
                <th>No HP</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data_ortu as $value) : ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= $value['no_hp']; ?></td>
                </tr>
            <?php
                $no++;
            endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $("#tb-ortu").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        })
    });
</script>