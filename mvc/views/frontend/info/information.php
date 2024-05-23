<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
    /* CSS tùy chỉnh cho card */
    .custom-card {
        background-color: #f8f9fa; /* Màu nền */
        border: 1px solid #dee2e6; /* Viền */
        border-radius: 10px; /* Góc bo tròn */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng */
        padding: 20px; /* Khoảng cách bên trong card */
        min-width: 450px; 
        margin: 0 auto; /* Căn giữa */
    }

    /* CSS cho tiêu đề của card */
    .custom-card h3 {
        font-size: 24px; /* Kích thước font */
        margin-bottom: 20px; /* Khoảng cách dưới */
    }

    /* CSS cho nút trong card */
    .custom-card .button_submit button {
        width: 100%; /* Chiều rộng đầy đủ */
    }
</style>

<div class="custom-card">
    <h3>Thông tin</h3>
    <form action="" method="post">
        <div class="mb-3">
            <label for="" class="form-label">Họ và tên</label>
            <input type="text" name="data_post[name]" value="<?= $data_index['user']['name'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Số điện thoại</label>
            <input type="text" name="data_post[phoneNumber]" class="form-control" value="<?= $data_index['user']['phoneNumber'] ?>">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="text" name="data_post[email]" class="form-control" required="" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" value="<?= $data_index['user']['email'] ?>">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Địa chỉ 1</label>
            <input type="text" name="data_post[address][address1]" class="form-control" required="" value="<?= isset($data_index['user']['address']['address1']) ? $data_index['user']['address']['address1'] : '' ?>">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Địa chỉ 2</label>
            <input type="text" name="data_post[address][address2]" class="form-control" required="" value="<?= isset($data_index['user']['address']['address2']) ? $data_index['user']['address']['address2'] : '' ?>">
        </div>
        <div class="button_submit">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
</div>
