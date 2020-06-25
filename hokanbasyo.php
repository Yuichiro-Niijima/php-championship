<!-- プロフィール -->


<div class="prf_box">
    <table class="prf_box_left">
        <tr>
            <td>社員番号：</td>
            <td><?= $result["id"] ?></td>
        </tr>
        <tr>
            <td>氏名：</td>
            <td><?= $result["student_name"] ?></td>
        </tr>
        <tr>
            <td>性別：</td>
            <td><?= $result["sex"] ?></td>
        </tr>
        <tr>
            <td>生年月日：</td>
            <td><?= $result["birthday"] ?></td>
        </tr>
    </table>
    <table class="prf_box_right">
        <tr>
            <td>部署：</td>
            <td><?= $result["department"] ?></td>
        </tr>
        <tr>
            <td>役職：</td>
            <td><?= $result["position"] ?></td>
        </tr>
        <tr>
            <td>雇用形態：</td>
            <td><?= $result["contract_type"] ?></td>
        </tr>
        <tr>
            <td>入社日：</td>
            <td><?= $result["start_date"] ?></td>
        </tr>

    </table>
</div>