<?php
namespace Xin\Thrift\MicroService;
/**
 * Autogenerated by Thrift Compiler (0.10.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;


interface AppIf {
  /**
   * @return string
   * @throws \Xin\Thrift\MicroService\ThriftException
   */
  public function version();
  /**
   * @return string
   * @throws \Xin\Thrift\MicroService\ThriftException
   */
  public function testException();
}


