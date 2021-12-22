<?php

class TemplateManager
{
    public function getTemplateComputed(Template $tpl, array $data)
    {
        if (!$tpl) {
            throw new \RuntimeException('no tpl given');
        }

        $replaced = clone($tpl);
        $replaced->subject = $this->computeText($replaced->subject, $data);
        $replaced->content = $this->computeText($replaced->content, $data);

        return $replaced;
    }

    private function computeText($text, array $data)
    {
        $APPLICATION_CONTEXT = ApplicationContext::getInstance();

        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;

        if ($quote)
        {
        //     $_quoteFromRepository = QuoteRepository::getInstance()->getById($quote->id);
        //     $usefulObject = SiteRepository::getInstance()->getById($quote->siteId);
            $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->destinationId);
            // if(strpos($text, '[quote:destination_link]') !== false){
            //     $destination = DestinationRepository::getInstance()->getById($quote->destinationId);
            // }
            // var_dump('oooooooossssssssssoooooo', strpos($text, '[quote:summary_html]'));

            // $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            // var_dump($containsSummaryHtml);
            // $containsSummary     = strpos($text, '[quote:summary]');

            // if ($containsSummaryHtml !== false || $containsSummary !== false) {
            //     if ($containsSummaryHtml !== false) {
            //         $text = str_replace(
            //             '[quote:summary_html]',
            //             Quote::renderHtml($_quoteFromRepository),
            //             $text
            //         );
            //     }
            //     if ($containsSummary !== false) {
            //         $text = str_replace(
            //             '[quote:summary]',
            //             Quote::renderText($_quoteFromRepository),
            //             $text
            //         );
            //     }
            // }

            (strpos($text, '[quote:destination_name]') !== false) and $text = str_replace('[quote:destination_name]',$destinationOfQuote->countryName,$text);
        }

        // if (isset($destination))
        //     $text = str_replace('[quote:destination_link]', $usefulObject->url . '/' . $destination->countryName . '/quote/' . $_quoteFromRepository->id, $text);
        // else
        //     $text = str_replace('[quote:destination_link]', '', $text);

        return $text;
    }
}
