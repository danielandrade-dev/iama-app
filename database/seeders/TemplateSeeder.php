<?php

namespace Database\Seeders;

use core\Enums\TemplateType;
use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        // Templates de notificação
        $notificationTemplates = [
            [
                'name' => 'ticket_created',
                'title' => 'Novo Ticket Criado',
                'content' => 'Um novo ticket foi criado com o número #{ticket_id}. Responsável: {analyst_name}',
                'type' => TemplateType::Notification,
            ],
            [
                'name' => 'ticket_updated',
                'title' => 'Ticket Atualizado',
                'content' => 'O ticket #{ticket_id} foi atualizado. Status: {status}',
                'type' => TemplateType::Notification,
            ],
            [
                'name' => 'transfer_request',
                'title' => 'Solicitação de Transferência',
                'content' => 'Nova solicitação de transferência de cliente. ID: {transfer_id}',
                'type' => TemplateType::Notification,
            ],
        ];

        // Templates de email
        $emailTemplates = [
            [
                'name' => 'welcome_email',
                'title' => 'Bem-vindo ao Sistema',
                'content' => 'Olá {user_name}, bem-vindo ao nosso sistema de tickets!',
                'type' => TemplateType::Email,
            ],
            [
                'name' => 'ticket_assigned',
                'title' => 'Ticket Atribuído',
                'content' => 'O ticket #{ticket_id} foi atribuído a você. Por favor, verifique.',
                'type' => TemplateType::Email,
            ],
            [
                'name' => 'transfer_approved',
                'title' => 'Transferência Aprovada',
                'content' => 'A transferência de cliente foi aprovada. Detalhes: {transfer_details}',
                'type' => TemplateType::Email,
            ],
        ];

        // Criar templates
        foreach (array_merge($notificationTemplates, $emailTemplates) as $template) {
            Template::create($template);
        }
    }
}
