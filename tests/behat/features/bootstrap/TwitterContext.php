<?php

use Behat\Behat\Context\ClosuredContextInterface,
	Behat\Behat\Context\TranslatedContextInterface,
	Behat\Behat\Context\BehatContext,
	Behat\Behat\Event\StepEvent,
	Behat\Gherkin\Node\PyStringNode,
	Behat\Gherkin\Node\TableNode,
	Behat\Behat\Exception\PendingException;

/**
 * Context for Tweeting
 */
class TwitterContext extends BehatContext
{
	/**
	 * Initializes context.
	 */
	public function __construct(array $parameters)
	{
		// Maybe set up things like OAuth or other credentials
	}

	//////////////////////////////////////////////////////////////////////
	// STEP DEFINITIONS /////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////
    /**
     * @When /^I check for recent tweets$/
     */
    public function iCheckForRecentTweets()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I see a tweet about my order$/
     */
    public function iSeeATweetAboutMyOrder()
    {
        throw new PendingException();
    }

}
