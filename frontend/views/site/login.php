<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\mongodb\Query;

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>เข้าสู่ระบบ</title>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Webestica.com">
  <meta name="description" content="Bootstrap based News, Magazine and Blog Theme">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../../themes/template/assets/images/favicon.ico">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Plugins CSS -->
  <link rel="stylesheet" type="text/css" href="../../themes/template/assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../../themes/template/assets/vendor/bootstrap-icons/bootstrap-icons.css">

  <!-- Theme CSS -->
  <link id="style-switch" rel="stylesheet" type="text/css" href="../../themes/template/assets/css/style.css">

</head>

<body>

  <main>

    <!-- =======================
Inner intro START -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
            <div class="p-4 p-sm-5 bg-primary-soft rounded">
              <h2>ระบบสารสนเทศภูมิศาสตร์​แหล่งท่องเที่ยวเชิงเกษตร​</h2>
              <!-- Form START -->

              <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                  'options' => [
                    'tag' => false,
                  ],
                ],
              ]);
              ?>
              <form class="mt-4">
                <div class="mb-3">
                  <label class="form-label">ชื่อผู้ใช้งาน</label>
                  <?= $form->field($model, 'username')->textInput(['maxlength' => 30, 'aria-describedby' => 'emailHelp', 'class' => 'form-control user_val check_users_status', 'placeholder' => 'กรุณากรอกชื่อผู้ใช้งาน', 'id' => 'exampleInputEmail1'])->label(false); ?>
                </div>

                <div class="mb-3">
                  <label class="form-label">รหัสผ่าน <a href="index.php?r=site/forgot_password" class="float-right small">ลืมรหัสผ่าน</a></label>
                  <?= $form->field($model, 'password')->passwordInput(['maxlength' => 30, 'class' => 'form-control pass_val check_users_status', 'placeholder' => 'กรุณากรอกรหัสผ่าน', 'id' => 'exampleInputPassword1'])->label(false); ?>

                </div>
                <!-- Checkbox -->
                <div class="mb-3 form-check">
                  <?= $form->field($model, 'rememberMe', ['options' => ['class' => 'custom-control-input']])->checkbox(); ?>
                  <!-- <label class="form-check-label" for="exampleCheck1">keep me signed in</label> -->
                </div>
                <!-- Button -->
                <div class="row align-items-center">
                  <div class="col-sm-4">
                    <input type="hidden" name="check_users_status" id="check_users_status">
                    <?= Html::submitButton('เข้าสู่ระบบ', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button', 'id' => 'verifyButton']) ?>
                    <!-- <button type="submit" class="btn btn-success">Sign me in</button> -->
                  </div>
                  <!-- <div class="col-sm-8 text-sm-end">
                                        <span>Don't have an account? <a href="signup.html"><u>Sign up</u></a></span>
                                    </div> -->

                </div>
              </form>

              <?php ActiveForm::end(); ?>
              <!-- Form END -->
              <hr>
              <!-- Social-media btn -->
              <!-- <div class="text-center">
                                <p>Sign in with your social network for quick access</p>
                                <ul class="list-unstyled d-sm-flex mt-3 justify-content-center">
                                    <li class="mx-2">
                                        <a href="#" class="btn bg-facebook d-inline-block"><i
                                                class="fab fa-facebook-f me-2"></i> Sign in with Facebook</a>
                                    </li>
                                    <li class="mx-2">
                                        <a href="#" class="btn bg-google d-inline-block"><i
                                                class="fab fa-google me-2"></i> Sign in with google</a>
                                    </li>
                                </ul>
                            </div> -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- =======================
Inner intro END -->

  </main>

  <!-- Back to top -->
  <div class="back-top"><i class="bi bi-arrow-up-short"></i></div>


  <!-- Bootstrap JS -->
  <script src="../../themes/template/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Template Functions -->
  <script src="../../themes/template/assets/js/functions.js"></script>

</body>

</html>