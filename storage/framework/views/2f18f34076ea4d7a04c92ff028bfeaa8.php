<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title','UKK E-Commerce'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .app-viewport {
            min-height: 100vh;
            background: #474747;
            padding: 26px;
        }

        .app-canvas {
            max-width: 1368px;
            min-height: calc(100vh - 52px);
            margin: 0 auto;
            background: #f3f4f6;
            border: 1px solid #dadde1;
            display: flex;
            overflow: hidden;
        }

        .ui-card {
            background: #ffffff;
            border: 1px solid #e1e4e8;
            border-radius: 12px;
        }

        .ui-input {
            width: 100%;
            border: 1px solid #d9dde3;
            border-radius: 9px;
            background: #ffffff;
            height: 40px;
            padding: 0 12px;
            font-size: 13px;
            color: #111827;
        }

        .ui-input::placeholder {
            color: #97a0ad;
        }

        .ui-input:focus,
        .ui-textarea:focus {
            outline: none;
            border-color: #111827;
            box-shadow: 0 0 0 3px rgba(17, 24, 39, 0.08);
        }

        .ui-textarea {
            width: 100%;
            border: 1px solid #d9dde3;
            border-radius: 9px;
            background: #ffffff;
            min-height: 108px;
            padding: 10px 12px;
            font-size: 13px;
            color: #111827;
            resize: vertical;
        }

        .btn-dark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 10px;
            background: #020617;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            padding: 10px 16px;
            transition: .2s ease;
        }

        .btn-dark:hover {
            background: #0f172a;
        }

        .btn-mint {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 10px;
            background: #33d387;
            color: #04110a;
            font-size: 13px;
            font-weight: 700;
            padding: 10px 16px;
            transition: .2s ease;
        }

        .btn-mint:hover {
            background: #25c578;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 10px;
            border: 1px solid #d9dde3;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            padding: 10px 16px;
            transition: .2s ease;
            background: #fff;
        }

        .btn-outline:hover {
            background: #f8fafc;
        }

        .admin-side-link {
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 13px;
            font-weight: 600;
            color: #95a0b2;
            transition: .2s ease;
        }

        .admin-side-link svg {
            width: 17px;
            height: 17px;
        }

        .admin-side-link:hover {
            color: #e5e7eb;
            background: rgba(148, 163, 184, .12);
        }

        .admin-side-link.active {
            background: #37d48d;
            color: #02130b;
        }

        .admin-side-link.active svg {
            color: #02130b;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            display: inline-block;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <?php echo $__env->yieldContent('content'); ?>
    <?php if(auth()->guard()->check()): ?>
        <?php echo $__env->make('partials.logout-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\uprak-ecommerce\resources\views\layouts\app.blade.php ENDPATH**/ ?>