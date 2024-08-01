<?php
interface Component
{
    public function operation(): string;
}

// компонент, не содержащий дочерних элементов
class Leaf implements Component
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function operation(): string
    {
        return $this->name;
    }
}

// компонент, содержащий дочерние элементы
class Composite implements Component
{
    private array $children = [];

    public function add(Component $component): void
    {
        $this->children[] = $component;
    }

    public function remove(Component $component): void
    {
        $index = array_search($component, $this->children, true);
        if ($index !== false) {
            unset($this->children[$index]);
        }
    }

    public function operation(): string
    {
        $results = [];
        foreach ($this->children as $child) {
            $results[] = $child->operation();
        }

        return 'Composite(' . implode('+', $results) . ')';
    }
}

// Клиентский код
function clientCode(Component $component)
{
    echo "RESULT: " . $component->operation() . "<br />";
}

// Пример использования
$simpleLeaf = new Leaf("Leaf 1");
echo "Client: Простой компонент:<br />";
clientCode($simpleLeaf);
echo "\n";

$tree = new Composite();
$branch1 = new Composite();
$branch1->add(new Leaf("Лист 2"));
$branch1->add(new Leaf("Лист 3"));
$tree->add($branch1);

$branch2 = new Composite();
$branch2->add(new Leaf("Лист 4"));
$tree->add($branch2);

echo "Client: Композитное дерево:<br />";
clientCode($tree);
echo "<br />";

echo "Client: Дерево:<br />";
clientCode($tree);
