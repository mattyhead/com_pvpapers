<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Nomination View for Pvpapers Component
 *
 * @package    Philadelphia.Votes
 * @subpackage Components
 * @license    GNU/GPL
 */
class PvpapersViewPaper extends JView
{
    /**
     * display method of Nomination view
     * @return void
     **/
    public function display($tpl = null)
    {

        $paper = &$this->get('Data');
        $isNew      = ($paper->id < 1);

        $text = $isNew ? JText::_('New') : JText::_('Edit');
        JToolBarHelper::title(JText::_('Nomination Paper') . ': <small><small>[ ' . $text . ' ]</small></small>');

        JToolBarHelper::cancel('cancel', 'Close');

        JToolBarHelper::preferences( 'com_pvpapers' );

        $this->assignRef('paper', $paper);
        $this->assignRef('isNew', $isNew);

        parent::display($tpl);
    }
}
