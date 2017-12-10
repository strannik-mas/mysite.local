<?php   
abstract class Component
{
	abstract public function Operation();
}
class ConcreteComponent extends Component
{
	public function Operation()
	{
		return 'I am component';
	}
}
abstract class Decorator extends Component
{
	protected
		$_component = null;
	public function __construct(Component $component)
	{
		$this -> _component = $component;
	}
	protected function getComponent()
	{
		return $this -> _component;
	}
	public function Operation()
	{
		return $this -> getComponent() -> Operation();
	}
}
class ConcreteDecoratorA extends Decorator
{
	public function Operation()
	{
		return "<a href='www.popmech.ru'>" . parent::Operation() . '</a>';//интересно, что применяется к обоим объектам
	}
}
class ConcreteDecoratorB extends Decorator
{
	public function Operation()
	{
		return '<strong>' . parent::Operation() . '</strong>';
	}
}
// Example
$Element = new ConcreteComponent();
$ExtendedElement = new ConcreteDecoratorA($Element);
$SuperExtendedElement = new ConcreteDecoratorB($ExtendedElement);
print $SuperExtendedElement -> Operation(); // <strong><a>I am component</a></strong>
echo '<br>'.$ExtendedElement->Operation();
?>