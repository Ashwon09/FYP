@component('mail::message')
# Offer Received

{{$data['user']}} made an offer for {{$data['game']}} game

@component('mail::table')
|  |  |
| ------------- |:-------------:|
| Offer from | {{$data['user']}} |
| Offer for | {{$data['game']}}|
| Offer Type | {{$data['offer_type']}} |
| Offer of | {{$data['offer']}} |
| Number of offerer | {{$data['phone']}} |

@endcomponent

Thanks,<br>
@endcomponent
