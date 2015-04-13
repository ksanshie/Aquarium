<?php
/*
 Класс Аквариум
Скрытые поля:
• Номер по порядку (назначается автоматически);
• Объём (генерируется случайно);
• Количество видов рыбок (генерируется случайно);
• Название рыбки (динамический массив, значение элементов которого выбирается случайно из заготовленных вариантов
считаных из файла);
• Количество рыбок одного вида (динамический массив, значение элементов которого генерируется случайным образом в
диапазоне 1-5);
• Всего рыбок в аквариуме (вычисляется, исходя из предыдущих данных).

Публичные поля:
• Статический счётчик количества экземпляров.

Скрытые методы:
• Вычисление количества рыбок в аквариуме.

Публичные методы:
• Конструктор (присваивает значения всем полям);
• Деструктор (уменьшает статический счётчик);
• Ручная смена количества рыбок выбранного вида в выбранном аквариуме (с пересчётом общего числа рыбок в аквариуме);
• Вывод на экран всех полей (кроме статических);

***************
Программа:
Создать массив экземпляров класса из 20 элементов. Затем предложить пользователю меню, позволяющее запускать публичные
методы (кроме конструктора и деструктора), выводить данные на экран в таких режимах:
• Вывод на экран всего списка;
• Вывод на экран одного экземпляра с заданным порядковым номером;
• Вывод на экран количества рыбок выбранного типа во всех аквариумах;
а также выйти из программы. Меню зациклить. После выполнения каждого пункта очищать экран. Предусмотреть максимальное
количество ошибок пользователя.

Создать второй класс, который будет вести лог программы. Все его методы должны перегружать друг друга. В лог
записываются такие данные: время события, номер экземпляра класса вызвавшего событие, метод вызвавший событие,
входящие и исходящие данные события, успешность события. Все экземпляры основного класса должны взаимодействовать
с одним, общим, экземпляром класса-логгера.
*/

class Aquarium {
    private $number;
    private $volume;
    private $speciesCount;
    private $fishName;
    private $fishNameCount; //rand 1,5
    private $fishCount;

    const VOL_MIN = 100;
    const VOL_MAX = 500;
    const SPECIES_MIN = 1;
    const SPECIES_MAX = 3;
    const FISH_SAME_SPECIE_MIN = 1;
    const FISH_SAME_SPECIE_MAX = 5;

    public static $examples;

    private function getFishCount(){
        $fishCount = 0;
        for ($spCount = 0; $spCount < $this->speciesCount; $spCount++){
            $fishCount += $this->fishNameCount[$spCount];
        }
        return $fishCount;
    }

    public function  __Aquarium(){
        $this->number = 1; //рассчитывать автоматически
        $allNames = $this->getFishName();
        $this->volume = rand(self::VOL_MIN,self::VOL_MAX);
        $this->speciesCount = rand(self::SPECIES_MIN,self::SPECIES_MAX);
        for ($spCount = 0; $spCount < $this->speciesCount; $spCount++){
            $this->fishName[$spCount] = $allNames[$spCount];
            $this->fishNameCount[$allNames[$spCount]] = rand(self::FISH_SAME_SPECIE_MIN,self::FISH_SAME_SPECIE_MAX);
        }
        $this->fishCount = $this->getFishCount();
    }

    public function setFish($name,$count){
        $this->fishNameCount[$name] = $count;
        $this->fishCount = $this->getFishCount();
        return $this->fishNameCount[$name];
    }

    public function getAllFields(){
        print_r($this->number.' '.
            $this->volume.' '.
            $this->speciesCount.' '.
            $this->fishName.' '.
            $this->fishNameCount.' '.
            $this->fishCount);
    }

    private function getFishName(){
        return array('Медвед', 'Ктулху', 'Креведко');
    }
}

