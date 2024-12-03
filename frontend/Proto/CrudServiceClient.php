<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Proto;

/**
 */
class CrudServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Proto\Item $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function CreateItem(\Proto\Item $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/proto.CrudService/CreateItem',
        $argument,
        ['\Proto\ResponseWithId', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Proto\ItemId $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ReadItem(\Proto\ItemId $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/proto.CrudService/ReadItem',
        $argument,
        ['\Proto\Item', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Proto\Item $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function UpdateItem(\Proto\Item $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/proto.CrudService/UpdateItem',
        $argument,
        ['\Proto\Response', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Proto\ItemId $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DeleteItem(\Proto\ItemId $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/proto.CrudService/DeleteItem',
        $argument,
        ['\Proto\Response', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Proto\ItemList $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListItems(\Proto\ItemList $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/proto.CrudService/ListItems',
        $argument,
        ['\Proto\ItemList', 'decode'],
        $metadata, $options);
    }

}
