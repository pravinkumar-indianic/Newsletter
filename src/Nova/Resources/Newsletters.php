<?php
namespace Indianic\Newsletters\Nova\Resources;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\DateTime;
use Trin4ik\NovaSwitcher\NovaSwitcher;
use Laravel\Nova\Http\Requests\NovaRequest;


class Newsletters extends Resource {


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Indianic\Newsletters\Models\Newsletters::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';
    
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','title', 'content', 'newsletter_option', 'date_time', 'all_user'
    ];

    
    public function fields(NovaRequest $request) {
        return [
            ID::make()->sortable(),
            
            Text::make('Title')
                    ->sortable()
                    ->withMeta(['extraAttributes' => [
                            'placeholder' => 'Title']
                    ])
                    ->rules('required', 'max:255'),
            
            Trix::make('Content', 'content')
                    ->rules('required'),
            
            Select::make('When to send', 'newsletter_option')->options([
                1 => 'Send Later',
                0 => 'Send Now'
            ])->displayUsingLabels(),

            DateTime::make('SELECT DATE & TIME', 'date_time')
                ->readonly()
                ->dependsOn(
                    ['newsletter_option'],
                    function (DateTime $field, NovaRequest $request, FormData $formData) {
                        if ($formData->newsletter_option == 1) {
                            $field->readonly(false)->rules(['required']);
                        }
                    }
                ),
            
            Boolean::make('All User','all_user')
                    ->trueValue('On')
                    ->falseValue('Off')
                    ->hideWhenUpdating(),
                        
            NovaSwitcher::make('Status')            
        ];
    }

    public function cards(NovaRequest $request) {
        return [];
    }

    public function filters(NovaRequest $request) {
        return [];
    }

    public function lenses(NovaRequest $request) {
        return [];
    }

    public function actions(NovaRequest $request) {
        return [];
    }

}
