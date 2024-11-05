<?php

namespace Botble\RealEstate\Tables;

use Botble\Table\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;

class UnverifiedAccountTable extends AccountTable
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->removeActions(['edit', 'delete'])
            ->addAction(
                Action::make('moderate')
                    ->icon('ti ti-eye')
                    ->permission('account.edit')
                    ->url(fn (Action $action) => route('unverified-accounts.show', $action->getItem()))
                    ->color('primary')
                    ->label(trans('plugins/real-estate::account.moderate'))
            );
    }

    protected function getQuery(): Relation|Builder|QueryBuilder
    {
        return $this->query()->whereNull('approved_at');
    }

    public function buttons(): array
    {
        return [];
    }
}
