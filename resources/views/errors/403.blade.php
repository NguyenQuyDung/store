<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: "Montserrat";
            color: rgb(56, 56, 56);
        }

        .wrapper {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .wrapper h1 {
            font-size: 3rem;
            margin-top: 20px;
        }

        .wrapper .message {
            font-size: 1.5rem;
            padding: 20px;
            width: 60%;
            text-align: center;
        }

        .wrapper .btn {
            background: rgb(0, 195, 154);
            padding: 20px;
            font-size: 1.5rem;
            text-decoration: none;
            color: #fff;
        }

        .wrapper .btn:hover {
            background: rgb(0, 231, 201);
        }

        .wrapper .copyRights {
            margin-top: 50px;
        }
    </style>
    <img style="height:100px;" src="https://mona.media/wp-content/uploads/2021/07/error-403-forbidden.png" alt="">
    <div class="wrapper">
        <h1>Xin Lỗi</h1>
        <p class="message" style="margin-bottom:0px; padding:10px 0px;">
            Bạn không có quyền truy cập vào trang này, vui lòng quay lại để tiếp tục thao tác khác, Xin cảm ơn !
        </p>
        <p style="padding: 10px 0px; color:blueviolet; font-size:18px;">
           You don't have peermission to access this page !
        </p>
        <a href="https://quantrimang.com/" class="btn">Đọc Thêm Về Quyền Truy Cập</a>
        <p class="copyRights font-weight-bold" style="font-weight: bold; color:red;"> <b class="text-danger">ADMIN</b>: Nguyen Quy Dung</p>
    </div>
</body>

</html>