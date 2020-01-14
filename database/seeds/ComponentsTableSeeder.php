<?php

use Illuminate\Database\Seeder;

class ComponentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $components = [
            'Strategische partners'  => 'success.jpg',
            'Kernactiviteiten'  => 'kernactiviteiten.jpg',
            'Mensen en middelen'  => 'people.jpg',
            'Waardepropositie'  => 'value-proposition.png',
            'Klantrelaties'  => 'klantrelaties.jpg',
            'Kanalen'  => 'kanalen.jpg',
            'Klantsegmenten'  => 'segement.png',
            'Kostenstructuur'  => 'money.jpg',
            'Inkomstenstromen'  => 'inkomstenstromen.jpg'
        ];


        $dComponents = [
            1 => [
                "Welke externe strategische partners zijn nodig om het
                 product succesvol te kunnen creëren, verkopen, leveren?",
                "Wat is hun rol en toegevoegde waarde in het hele proces?"],
            2 => [
                "Wat zijn de noodzakelijke activiteiten
                om het product succesvol te kunnen
                creëren, verkopen en leveren?",
                "Kijk ook naar Kanalen, Klantrelaties en Inkomstenbronnen."],
            3 => [
                "Welke mensen en middelen zijn intern
                 nodig om het product succesvol te
                 kunnen creëren, verkopen en leveren?",
                "Kiitjk ook naar Kanalen, Klantrelaties en Inkomstenbronnen."],
            4 => [
                "Wat is het aanbod voor de klant?",
                "Bij welke behoefte past dit? Welk probleem wordt er opgelost?",
                "Welke pakketten bieden we aan?",
                "Is er een aangepast aanbod voor bepaalde klantsegmenten?"],
            5 => [
                "Hoe worden relaties met klanten gelegd en onderhouden?",
                "Wat is de toegevoegde waarde van de verschillende typen relaties?"],
            6 => [
                "Hoe kunnen de klanten worden bereikt?",
                "Welke kanalen werken het beste?",
                "Hoe kunnen we kanalen integreren?"],
            7 => [
                "Voor wie wordt er waarde gecreëerd?",
                "Wie zijn de belangrijkste klanten?",
                "Wat zijn hun specifieke kenmerken en behoeftes?"],
            8 => [
                "Wat zijn de kosten van de ontwikkeling?",
                " Wat zijn de belangrijkste vaste en variabele kosten na introductie?",
                "Welke kosten brengen de Kernactiviteiten en de Key resources met zich mee?",
                " Hoe ziet de kostenstructuur op langere termijn eruit?"],
            9 => [
                "Wat is het verdienmodel?",
                "Waar zijn klanten bereid voor te betalen?",
                "Hoe is de prijs opgebouwd? Wat zijn alternatieve manieren om inkomsten te krijgen?",
                "Op welk moment en op welke manier wordt de betaling verricht?",
            ]
        ];

        $counter = 0;
        foreach ($components as $component => $thumb){
            $counter++;
            DB::table('components')->insert([
                'name' => $component,
                'thumb' => $thumb,
                'description' => json_encode($dComponents[$counter])
        ]);
        }

    }
}
