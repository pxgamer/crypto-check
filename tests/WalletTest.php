<?php

namespace pxgamer\CryptoCheck;

use PHPUnit\Framework\TestCase;

class WalletTest extends TestCase
{
    const VALID_BTC_ADDRESS = '3MZmTtzaxPKba7V5fffsuE6dFuztqdxKoE';
    const VALID_ETH_ADDRESS = '0x738a4a2bCdD9Eec0dCF4cc919D183Cd1d23492Fa';
    const VALID_DASH_ADDRESS = 'XxiPH764eZfJR3dt4XjApdHoUEptrqcn8k';
    const VALID_LITECOIN_ADDRESS = 'LPJmhoT2c4YG79Jd2zqAe4ze9m966qv2B9';
    const VALID_DOGECOIN_ADDRESS = 'D596vyvpytFZRpVQpHwQ2gzy7J8CV6nMJv';
    const INVALID_ADDRESS = '3MZmTtzap1JLPKb2a7V5fffsuE6dFr21rqdxKoE';

    /**
     * Test that the read() method creates a new wallets config file.
     * @throws \Exception
     */
    public function testCreatesFileOnRead()
    {
        Wallet::read();
        $this->assertFileExists(Wallet::WALLET_CONFIG);
    }

    /**
     * Test that the validate() method throws an exception on an invalid coin type.
     * @throws \Exception
     */
    public function testThrowExceptionOnInvalidCoinType()
    {
        $this->expectException(Exceptions\InvalidWalletTypeException::class);
        Wallet::validate(self::VALID_BTC_ADDRESS, 'Botchain');
    }

    /**
     * Test that the validate() method throws an exception on an invalid Bitcoin address.
     * @throws \Exception
     */
    public function testThrowExceptionOnInvalidBitcoinAddress()
    {
        $this->expectException(Exceptions\InvalidAddressFormatException::class);
        Wallet::validate(self::INVALID_ADDRESS, Wallet::BITCOIN);
    }

    /**
     * Test that the validate() method throws an exception on an invalid Ethereum address.
     * @throws \Exception
     */
    public function testThrowExceptionOnInvalidEthereumAddress()
    {
        $this->expectException(Exceptions\InvalidAddressFormatException::class);
        Wallet::validate(self::INVALID_ADDRESS, Wallet::ETHEREUM);
    }

    /**
     * Test that the validate() method throws an exception on an invalid Dash address.
     * @throws \Exception
     */
    public function testThrowExceptionOnInvalidDashAddress()
    {
        $this->expectException(Exceptions\InvalidAddressFormatException::class);
        Wallet::validate(self::INVALID_ADDRESS, Wallet::DASH);
    }

    /**
     * Test that the validate() method throws an exception on an invalid Litecoin address.
     * @throws \Exception
     */
    public function testThrowExceptionOnInvalidLitecoinAddress()
    {
        $this->expectException(Exceptions\InvalidAddressFormatException::class);
        Wallet::validate(self::INVALID_ADDRESS, Wallet::LITECOIN);
    }

    /**
     * Test that the validate() method throws an exception on an invalid Dogecoin address.
     * @throws \Exception
     */
    public function testThrowExceptionOnInvalidDogecoinAddress()
    {
        $this->expectException(Exceptions\InvalidAddressFormatException::class);
        Wallet::validate(self::INVALID_ADDRESS, Wallet::DOGECOIN);
    }

    /**
     * Test that the validate() method returns true on a valid Bitcoin address.
     * @throws \Exception
     */
    public function testReturnTrueOnValidBitcoinAddress()
    {
        $result = Wallet::validate(self::VALID_BTC_ADDRESS, Wallet::BITCOIN);

        $this->assertTrue($result);
    }

    /**
     * Test that the validate() method returns true on a valid Ethereum address.
     * @throws \Exception
     */
    public function testReturnTrueOnValidEthereumAddress()
    {
        $result = Wallet::validate(self::VALID_ETH_ADDRESS, Wallet::ETHEREUM);

        $this->assertTrue($result);
    }

    /**
     * Test that the validate() method returns true on a valid Dash address.
     * @throws \Exception
     */
    public function testReturnTrueOnValidDashAddress()
    {
        $result = Wallet::validate(self::VALID_DASH_ADDRESS, Wallet::DASH);

        $this->assertTrue($result);
    }

    /**
     * Test that the validate() method returns true on a valid Litecoin address.
     * @throws \Exception
     */
    public function testReturnTrueOnValidLitecoinAddress()
    {
        $result = Wallet::validate(self::VALID_LITECOIN_ADDRESS, Wallet::LITECOIN);

        $this->assertTrue($result);
    }

    /**
     * Test that the validate() method returns true on a valid Dogecoin address.
     * @throws \Exception
     */
    public function testReturnTrueOnValidDogecoinAddress()
    {
        $result = Wallet::validate(self::VALID_DOGECOIN_ADDRESS, Wallet::DOGECOIN);

        $this->assertTrue($result);
    }

    /**
     * Test that the add() method successfully adds a Bitcoin wallet address.
     * @throws \Exception
     */
    public function testCanAddBitcoinAddress()
    {
        $result = Wallet::add(self::VALID_BTC_ADDRESS, Wallet::BITCOIN);

        $this->assertTrue($result);
    }

    /**
     * Test that the remove() method successfully removes a Bitcoin wallet address.
     * @throws \Exception
     */
    public function testCanRemoveBitcoinAddress()
    {
        $result = Wallet::remove(self::VALID_BTC_ADDRESS, Wallet::BITCOIN);

        $this->assertTrue($result);
    }

    /**
     * Test that the remove() method throws an exception on an invalid Bitcoin wallet address.
     * @throws \Exception
     */
    public function testCanRemoveNonExistentBitcoinAddress()
    {
        $this->expectException(Exceptions\WalletNotFoundException::class);
        Wallet::remove(self::INVALID_ADDRESS, Wallet::BITCOIN);
    }

    /**
     * Test that the list() method returns an array.
     * @throws \Exception
     */
    public function testCanListWalletAddresses()
    {
        $result = Wallet::list(Wallet::BITCOIN);
        $this->assertInternalType('array', $result);

        $result = Wallet::list();
        $this->assertInternalType('array', $result);
    }
}
