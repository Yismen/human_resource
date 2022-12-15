 # Dainsys Human Resource
 A full stack package to add human_resource functionality to Laravel applications. 

#### Features
1. Events
   1. Email is sent when employee is created
   2. Email is sent when employee is terminated
   3. Email is sent when employee is reactivated
   4. Email is sent when employee is suspended
2. Schedulled commands
   1. Daily at 3:00 am will check if a employee status needs to be changed based on wether or not it has an active suspension.
   2. Daily at 4:00 it will send an email with any active employee having birthday today.
   3. Montly at 4:00 on the 1st it will send emails with employees having birthdays this month and last month. Also on the 25th of each month it will send emails with employees having birthday next month.
   4. Daily report with the employees missing any information, such as supervisor, other data, afp, ars, etc.
3. Dashboard
   1. Visit your `/hr/admin/dashboard` to view all stats, such as Current Count, Suspended, MTD Attrition, Issues, Monthly Head Count, Monthly attrition and splits by different categories. You can also filter all stats by site using the Filter floating window in the UI, located at the bottom of the page.
4. Automatic Employee Status
   1. The application does not give you the option to update employee status by your self. However, it is updated based on different events happening with the employee:   
      1. When an employee is created, the status will automatically change to `Current`.
      2. When a suspension is added for the employee, it will check if the current date is within the range provided. If so, it will change the status to `Suspended`. It will automatically revert to `Current` once all suspensions are dued.
      3. When an employee is terminated, it will automatically change its status to `Inactive`.
      4. If you reactivate the employee, it's status will revert to `Current`. 

 ### Installation
 1. Require using composer: `composer require dainsys/human_resource`.
 2. Use the `php artisan human_resource:install` command, which will publish the assets and ask some configuration questions. 
    1. optionally, you can add the following line to your `composer` file, under the `scripts` and `post-update-cmd` key, to publish the assets every time you update your composer dependencies: `@php artisan vendor:publish --tag=human_resource:assets --force --ansi`.
 3. Run the migrations: `php artisan migrate`.
    1. If you may want to customize the migrations before this step, first publish them: `@php artisan vendor:publish --force --tag=human_resource:migrations`.
 4. In your `.env` file, add the following line with list of users who should have super_admin access: `HUMAN_RESOURCE_SUPER_USERS= some@email.com,another@email.com`
 5. Optionally,:
    1. ou may want to publish and tweek the config file: `@php artisan vendor:publish --force --tag=human_resource:config`.
    2. This package has its own views, designed with livewire and CoreUi. However, if you may want to change them then you can publish them with `@php artisan vendor:publish --force --tag=human_resource:views`. 
    3. Package views extend it's own layout app. However, you can change this by adding the key `INVOICE_LAYOUT_VIEW` to your `.env` file. Or, change it directly in the `human_resource` config file, under the `layout` key.
##### Configure your application
1. Visit route `/hr/admin` to view the dashboard and visit various app links to prepare your sistem.
2. This package extends the `dainsys/reports` package to report events and scheduled taks, so please complete the followint two steps:
   1. Visit the `/report/admin/recipients` end point and add the different recipients of you application.
   2. Visit the `/report/admin/mailables` to add all of your mailables and assign them with your recipients.
