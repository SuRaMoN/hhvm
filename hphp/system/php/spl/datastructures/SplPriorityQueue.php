<?php

class _SplPriorityQueueHeap extends SplMaxHeap {

  public $priorityQueue;

  public function __construct(SplPriorityQueue $priority_queue) {
    $this->priorityQueue = $priority_queue;
  }

  public function compare($a, $b) {
    return $this->priorityQueue->compare($a['priority'], $b['priority']);
  }

  public function top() {
    // I know that the parent routes all requests through top()
    // so this is the only method I need to change.
    $result = parent::top();
    $flags = $this->priorityQueue->getExtractFlags();
    if (($flags & SplPriorityQueue::EXTR_BOTH) == SplPriorityQueue::EXTR_BOTH) {
      return $result;
    } else if ($flags & SplPriorityQueue::EXTR_DATA) {
      return $result['data'];
    } else if ($flags & SplPriorityQueue::EXTR_PRIORITY) {
      return $result['priority'];
    }
    // really zend? NULL?
    return null;
  }
}

// This doc comment block generated by idl/sysdoc.php
/**
 * ( excerpt from http://docs.hhvm.com/manual/en/class.splpriorityqueue.php )
 *
 * The SplPriorityQueue class provides the main functionalities of an
 * prioritized queue, implemented using a max heap.
 *
 */
class SplPriorityQueue implements \HH\Iterator, Countable {

  const EXTR_DATA = 1;
  const EXTR_PRIORITY = 2;
  const EXTR_BOTH = 3;

  private $flags = self::EXTR_DATA;
  private $heap;

  final private function getHeap() {
    if ($this->heap === null) {
      $this->heap = new _SplPriorityQueueHeap($this);
    }
    return $this->heap;
  }


  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.compare.php )
   *
   * Compare priority1 with priority2.
   *
   * @priority1  mixed   The priority of the first node being compared.
   * @priority2  mixed   The priority of the second node being compared.
   *
   * @return     mixed   Result of the comparison, positive integer if
   *                     priority1 is greater than priority2, 0 if they are
   *                     equal, negative integer otherwise.
   *
   *                     Multiple elements with the same priority will get
   *                     dequeued in no particular order.
   */
  public function compare($priority1, $priority2) {
    if ($priority1 > $priority2) {
      return 1;
    } else if ($priority1 < $priority2) {
      return -1;
    }
    return 0;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.extract.php )
   *
   *
   * @return     mixed   The value or priority (or both) of the extracted
   *                     node, depending on the extract flag.
   */
  public function extract() {
    return $this->getHeap()->extract();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.insert.php )
   *
   * Insert value with the priority priority in the queue.
   *
   * @value      mixed   The value to insert.
   * @priority   mixed   The associated priority.
   *
   * @return     mixed   No value is returned.
   */
  public function insert($value, $priority) {
    $data = array('data' => $value, 'priority' => $priority);
    return $this->getHeap()->insert($data);
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.isempty.php )
   *
   *
   * @return     mixed   Returns whether the queue is empty.
   */
  public function isEmpty() {
    return $this->getHeap()->isEmpty();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from
   * http://docs.hhvm.com/manual/en/splpriorityqueue.recoverfromcorruption.php )
   *
   *
   * @return     mixed   No value is returned.
   */
  public function recoverFromCorruption() {
    return $this->getHeap()->recoverFromCorruption();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.count.php )
   *
   *
   * @return     mixed   Returns the number of elements in the queue.
   */
  public function count() {
    return $this->getHeap()->count();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.current.php )
   *
   * Get the current datastructure node.
   *
   * @return     mixed   The value or priority (or both) of the current node,
   *                     depending on the extract flag.
   */
  public function current() {
    return $this->getHeap()->current();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.key.php )
   *
   * This function returns the current node index
   *
   * @return     mixed   The current node index.
   */
  public function key() {
    return $this->getHeap()->key();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.next.php )
   *
   * Extracts the top node from the queue.
   *
   * @return     mixed   No value is returned.
   */
  public function next() {
    return $this->getHeap()->next();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.rewind.php )
   *
   * This rewinds the iterator to the beginning. This is a no-op for heaps
   * as the iterator is virtual and in fact never moves from the top of the
   * heap.
   *
   * @return     mixed   No value is returned.
   */
  public function rewind() {
    return $this->getHeap()->rewind();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.top.php )
   *
   *
   * @return     mixed   The value or priority (or both) of the top node,
   *                     depending on the extract flag.
   */
  public function top() {
    return $this->getHeap()->top();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://docs.hhvm.com/manual/en/splpriorityqueue.valid.php )
   *
   * Checks if the queue contains any more nodes.
   *
   * @return     mixed   Returns TRUE if the queue contains any more nodes,
   *                     FALSE otherwise.
   */
  public function valid() {
    return $this->getHeap()->valid();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from
   * http://docs.hhvm.com/manual/en/splpriorityqueue.setextractflags.php )
   *
   *
   * @flags      mixed   Defines what is extracted by
   *                     SplPriorityQueue::current(), SplPriorityQueue::top()
   *                     and SplPriorityQueue::extract().
   *                     SplPriorityQueue::EXTR_DATA (0x00000001): Extract
   *                     the data SplPriorityQueue::EXTR_PRIORITY
   *                     (0x00000002): Extract the priority
   *                     SplPriorityQueue::EXTR_BOTH (0x00000003): Extract an
   *                     array containing both
   *
   *                     The default mode is SplPriorityQueue::EXTR_DATA.
   *
   * @return     mixed   No value is returned.
   */
  public function setExtractFlags($flags) {
     $this->flags = $flags;
  }

  public function getExtractFlags() {
     return $this->flags;
  }

  public function __clone() {
    if($this->heap) {
      $this->heap = clone $this->heap;
      $this->heap->priorityQueue = $this;
    }
  }

}
