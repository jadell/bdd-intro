<?php

use Behat\Behat\Context\ClosuredContextInterface,
	Behat\Behat\Context\TranslatedContextInterface,
	Behat\Behat\Context\BehatContext,
	Behat\Behat\Event\StepEvent,
	Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
	Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
	protected $stopOnFailure = false;

	/**
	 * Initializes context.
	 * Every scenario gets it's own context object.
	 *
	 * @param array $parameters context parameters (set them up through behat.yml)
	 */
	public function __construct(array $parameters)
	{
		if (isset($parameters['stop_on_failure'])) {
			$this->stopOnFailure = $parameters['stop_on_failure'];
		}
	}


	//////////////////////////////////////////////////////////////////////
	// HOOKS ////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * @AfterScenario
	 */
	public function pauseOnFailure($event)
	{
		if ($this->stopOnFailure && $event->getResult() == StepEvent::FAILED) {
			$this->iPauseTheTest();
		}
	}

	//////////////////////////////////////////////////////////////////////
	// STEP DEFINITIONS /////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Pause the test for inspection/debugging
	 *
	 * @Given /^I pause the test$/
	 */
	public function iPauseTheTest()
	{
		echo "Testing paused. Enter any key to continue.\n";
		fgets(STDIN);
	}

	/**
	 * @Then /^I am on the product page for "([^"]*)"$/
	 */
	public function iAmOnTheProductPageFor($productName)
	{
		$this->assertElementContains(".lead", $productName);
	}

	/**
	 * @Then /^the product price is "([^"]*)"$/
	 */
	public function theProductPriceIs($productPrice)
	{
		$this->assertElementContains(".product-price", $productPrice);
	}

	/**
	 * @Then /^the product unit size is "([^"]*)"$/
	 */
	public function theProductUnitSizeIs($productUnit)
	{
		$this->assertElementContains(".product-unit", $productUnit);
	}

	/**
	 * @Then /^I see the following list of products:$/
	 */
	public function iSeeTheFollowingListOfProducts(TableNode $table)
	{
		foreach ($table->getHash() as $i => $row) {
			$rowNum = $i + 1;
			$this->assertElementContains("table.product-table tbody :nth-child({$rowNum}) .product-name", $row['name']);
			$this->assertElementContains("table.product-table tbody :nth-child({$rowNum}) .product-price", $row['price']);
			$this->assertElementContains("table.product-table tbody :nth-child({$rowNum}) .product-unit", $row['unit']);
		}
	}

	/**
	 * @Then /^I am on the shopping cart page$/
	 */
	public function iAmOnTheShoppingCartPage()
	{
		$this->assertElementContains(".navbar-brand", "Your Shopping Cart");
	}

	/**
	 * @Then /^I have "([^"]*)" items? in my cart$/
	 */
	public function iHaveItemInMyCart($numItems)
	{
		$this->assertNumElements($numItems, 'table.shopping-cart tbody tr');
	}

	/**
	 * @Then /^I have the following items in my cart:$/
	 */
	public function iHaveTheFollowingItemsInMyCart(TableNode $table)
	{
		foreach ($table->getHash() as $i => $row) {
			$rowNum = $i + 1;
			$this->assertElementContains("table.shopping-cart tbody :nth-child({$rowNum}) .product-name", $row['name']);
			$this->assertElementContains("table.shopping-cart tbody :nth-child({$rowNum}) .product-price", $row['price']);
			$this->assertElementContains("table.shopping-cart tbody :nth-child({$rowNum}) .product-qty", $row['qty']);
			$this->assertElementContains("table.shopping-cart tbody :nth-child({$rowNum}) .product-total", $row['total']);
		}
	}

	/**
	 * @Then /^my grand total is "([^"]*)"$/
	 */
	public function myGrandTotalIs($grandTotal)
	{
		$this->assertElementContains(".grandtotal-price", $grandTotal);
	}

}
