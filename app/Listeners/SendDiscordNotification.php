<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\UserInformation;
use App\Service\DiscordWebhookService;

class SendDiscordNotification
{
    protected $discordWebhook;

    private const COLORS = [
        'created' => 0x36ff00,
        'updated' => 0xfff700,
        'deleted' => 0xff2d00,
        'restored' => 0xde5e00,
        'error' => 0xff0000
    ];

    
    public function __construct(DiscordWebhookService $discordWebhookService)
    {
        $this->discordWebhook = $discordWebhookService;
    }

    public function handleUserInformation(UserInformation $event): void
    {
        $action = $this->getAction($event->action);
        $color = $this->getColor($action);
        
        $this->sendNotification($event->user, $action, auth()->user(), $color);
    }

    protected function getAction(string $action): string
    {
        switch ($action) {
            case 'create':
                return 'created';
            case 'update':
                return 'updated';
            case 'delete':
                return 'deleted';
            case 'restore':
                return 'restored';
            default:
                return 'acción desconocida';
        }
    }

    protected function getColor(string $action): int
    {
        return self::COLORS[$action] ?? self::COLORS['error'];
    }

    protected function sendNotification($user, $action, $actor, $color)
    {
        try {
            $embed = [
                'title' => "🎉 Clases de bezos - Usuario {$action} 🎉",
                'color' => $color,
                'fields' => [
                    [
                        'name' => '💼 Id de user',
                        'value' => "{$user->id}",
                        'inline' => true,
                    ],
                    [
                        'name' => '👤 Nombre Completo',
                        'value' => "{$user->names} {$user->lastnames}",
                        'inline' => true,
                    ],
                    [
                        'name' => '📧 Correo Electrónico',
                        'value' => $user->email,
                        'inline' => false,
                    ],
                    [
                        'name' => '🏠 Dirección',
                        'value' => $user->address ?? 'No proporcionado',
                        'inline' => false,
                    ],
                    [
                        'name' => '🛠️ Realizado por',
                        'value' => "{$actor->names} {$actor->lastnames} con el ID {$actor->id}",
                        'inline' => false,
                    ],
                ],
                'footer' => [
                    'text' => implode(" | ", [
                        '📍 Realizado en Clase de bezos',
                        '🕒 Notificación realizada el ' . now()->format('d/m/y H:i')
                    ]),
                ],
                'timestamp' => now()->toIso8601String(),
                'author' => [
                    'name' => "👤 {$actor->names} {$actor->lastnames}",
                ],
            ];

            $this->discordWebhook->sendEmbed($embed);

        } catch (\Exception $e) {
            \Log::error("Error al enviar notificación de Discord: " . $e->getMessage());
        }
    }
}
