<?php

namespace SolrExplain\Tests\Domain\Explanation;

/**
 * Testcases for the php port of solr explain.
 *
 * @author Timo Schmidt <timo.schmidt@aoemedia.de>
 */
class ExplanationSolr3TestCase extends \SolrExplain\Tests\AbstractExplanationTestCase{

	/**
	 * @return void
	 */
	public function setUp() {}

	/**
	 * @return void
	 */
	public function tearDown() {}

	/**
	 *
	 * @return \SolrExplain\Domain\Explanation\Explain
	 */
	protected function getExplain($filename) {
		$fileContent = $this->getFixtureContent($filename.".txt");
		$content = new \SolrExplain\Domain\Explanation\Content($fileContent);
		$metaData = new \SolrExplain\Domain\Explanation\MetaData('P_164345','auto');
		$parser = new \SolrExplain\Domain\Explanation\Parser();

		$parser->injectExplain(new \SolrExplain\Domain\Explanation\Explain());
		$explain = $parser->parse($content,$metaData);

		return $explain;
	}

	/**
	 * @test
	 */
	public function testFixture001() {
		$explain = $this->getExplain('3.0.001');

		$this->assertNotNull($explain);
		$this->assertEquals(1, $explain->getChildren()->count());
		$this->assertEquals(2,$explain->getChild(0)->getChildren()->count());
		$this->assertEquals(2,$explain->getChild(0)->getParent()->getChild(0)->getChildren()->count());
		$this->assertEquals(0.8621642, $explain->getRootNode()->getScore());
		$this->assertEquals(0.8621642,$explain->getChild(0)->getScore());
	}

	/**
	 * @test
	 */
	public function testFixture002() {
		$explain = $this->getExplain('3.0.002');

		$this->assertNotNull($explain);
		$this->assertEquals(1.6506158, $explain->getRootNode()->getScore());
		$this->assertEquals(2, $explain->getChildren()->count());
	}

	/**
	 * @test
	 */
	public function testFixture003() {
		$explain = $this->getExplain('3.0.003');

		$this->assertNotNull($explain);
		$this->assertEquals(36.50278,$explain->getRootNode()->getScore());
		$this->assertEquals(2, $explain->getChildren()->count());
	}

	/**
	 * @test
	 */
	public function testFixture004() {
		$explain = $this->getExplain('3.0.004');

		$this->assertNotNull($explain);
		$this->assertEquals(0.524427,$explain->getRootNode()->getScore());
		$this->assertEquals(2, $explain->getChildren()->count());
	}

	/**
	 * @test
	 */
	public function testFixture005() {
		$explain = $this->getExplain('3.0.005');

		$this->assertNotNull($explain);
		$this->assertEquals(5.8746934,$explain->getRootNode()->getScore());
		$this->assertEquals(2, $explain->getChildren()->count());
	}
}