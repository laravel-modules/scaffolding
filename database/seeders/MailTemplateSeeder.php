<?php

namespace Database\Seeders;

use App\Models\MailTemplate;
use Illuminate\Database\Seeder;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailTemplate::factory()->create([
            'name:ar' => 'رسالة ترحيب',
            'name:en' => 'Welcome Email',
            'subject:ar' => 'مرحبًا بك في منصتنا 🎉',
            'subject:en' => 'Welcome to Our Platform 🎉',
            'content:ar' => '
                <p>مرحبًا %CUSTOMER_NAME%،</p>

                <p>نرحب بك في منصتنا! نحن سعداء بانضمامك إلينا.</p>

                <p>إليك بعض الأشياء التي يمكنك القيام بها للبدء:</p>
                <ul>
                    <li>أكمل ملفك الشخصي</li>
                    <li>استكشف ميزاتنا</li>
                    <li>تواصل مع المستخدمين الآخرين</li>
                </ul>

                <p>إذا كان لديك أي أسئلة، لا تتردد في الرد على هذا البريد الإلكتروني. نحن دائمًا هنا للمساعدة!</p>

                <p>مع أطيب التحيات،<br>
                فريق الدعم</p>
            ',
            'content:en' => '
                <p>Hi %CUSTOMER_NAME%,</p>

                <p>Welcome to our platform! We’re excited to have you on board.</p>

                <p>Here are a few things you can do to get started:</p>
                <ul>
                    <li>Complete your profile</li>
                    <li>Explore our features</li>
                    <li>Connect with other users</li>
                </ul>

                <p>If you have any questions, feel free to reply to this email. We’re always happy to help!</p>

                <p>Best regards,<br>
                The Support Team</p>
            ',
        ]);
    }
}
