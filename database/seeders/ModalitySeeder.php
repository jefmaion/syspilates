<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Modality;
use Illuminate\Database\Seeder;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $atividades = [
            'PIL' => 'Pilates',
            // 'YOG' => 'Yoga',
            // 'MED' => 'Meditação',
            // 'ALN' => 'Alongamento',
            // 'MOB' => 'Mobilidade Articular',
            // 'TFU' => 'Treinamento Funcional',
            // 'COR' => 'Core Training',
            // 'BAR' => 'Barre Fitness',
            // 'GIN' => 'Ginástica Natural',
            // 'LBF' => 'Liberação Miofascial',
            // 'RPG' => 'Reeducação Postural',
            // 'FEP' => 'Fortalecimento do Assoalho Pélvico',
            // 'ESC' => 'Exercícios para Escoliose',
            // 'GLU' => 'Treino de Glúteos e Pernas',
            // 'BRE' => 'Respiração Consciente (Breathwork)',
            // 'TAI' => 'Tai Chi Chuan',
            // 'QIG' => 'Qi Gong',
            // 'ZUM' => 'Zumba',
            // 'DAN' => 'Dança Terapêutica',
            // 'CAM' => 'Caminhada Orientada',
            // 'FRC' => 'Flexibilidade e Relaxamento',
            // 'STB' => 'Estabilidade e Equilíbrio',
            // 'HIT' => 'Treino de Baixo Impacto',
            // 'FUN' => 'Funcional Leve',
        ];

        foreach ($atividades as $sigla => $name) {
            Modality::create(['name' => $name, 'acronym' => $sigla]);
        }
    }
}
