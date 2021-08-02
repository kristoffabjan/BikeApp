@component('mail::message')
# Welcome

    
    Hey felow biker! Welcome to BikeFinder app. 
    If you want to find out more about bikes and shops, visit our page on the link below!


@component('mail::button', ['url' => 'http://bikeapp2.herokuapp.com/'])
Go to app
@endcomponent

Thanks,<br>
Bike Finder Team
@endcomponent
