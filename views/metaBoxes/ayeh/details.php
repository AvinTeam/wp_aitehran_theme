
<table class="form-table" role="presentation">
    <tbody>
        <tr>
            <th scope="row">آیه</th>
            <td>
                <textarea name="ayeh[ayeh]" class="w-100"><?php echo $ayeh?> </textarea>
            </td>
        </tr>
        <tr>
            <th scope="row">ترجمه</th>
            <td>
                <textarea name="ayeh[tarjomeh]" class="w-100"><?php echo $tarjomeh?></textarea>
            </td>
        </tr>

        <tr>
            <th scope="row">سوره</th>
            <td>
                <input name="ayeh[surah]" class="w-100" value="<?php echo $surah?>">
            </td>
        </tr>

        <tr>
            <th scope="row">آیه</th>
            <td>
                <input name="ayeh[verse]" class="w-100" value="<?php echo $verse?>">
            </td>
        </tr>

    </tbody>
</table>
